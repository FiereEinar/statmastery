<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GoogleToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Google\Client;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function loginView() {
        return view('login');
    }

    public function signupView() {
        return view('signup');
    }

    public function login(Request $request){
        $body = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'g-recaptcha-response' => ['required'],
        ]);

        // HTTP client
        $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
        $response = $guzzleClient->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ],
        ]);

        $data = json_decode((string) $response->getBody(), true);

        if (!($data['success'] ?? false)) {
            return back()->withErrors(['captcha' => 'CAPTCHA verification failed.'])->withInput();
        }

        // HTTPS client
        // $captchaResponse = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        //     'secret' => env('RECAPTCHA_SECRET_KEY'),
        //     'response' => $body['g-recaptcha-response'],
        //     'remoteip' => $request->ip(),
        // ]);

        // if (!$captchaResponse->json('success')) {
        //     return back()->withErrors(['captcha' => 'CAPTCHA verification failed.'])->withInput();
        // }

        if (auth()->guard('web')->attempt(['email' => $body['email'], 'password'=> $body['password']])) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }
        
        return back()->withErrors(['all' => 'Incorrect credentials'])->withInput();
    }

    public function signup(Request $request) {
        $body = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            // 'password' => [
            //     'required',
            //     'min:8',
            //     'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
            // ],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase() // at least one uppercase and one lowercase
                    ->letters()   // at least one letter
                    ->numbers()   // at least one number
                    ->symbols()   // at least one symbol
            ],
            'g-recaptcha-response' => ['required'],
        ]);

        // HTTP client
        $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
        $response = $guzzleClient->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ],
        ]);

        $data = json_decode((string) $response->getBody(), true);

        if (!($data['success'] ?? false)) {
            return back()->withErrors(['captcha' => 'CAPTCHA verification failed.'])->withInput();
        }

        // HTTPS
        // $captchaResponse = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        //     'secret' => env('RECAPTCHA_SECRET_KEY'),
        //     'response' => $body['g-recaptcha-response'],
        //     'remoteip' => $request->ip(),
        // ]);

        // if (!$captchaResponse->json('success')) {
        //     return back()->withErrors(['captcha' => 'CAPTCHA verification failed. Please try again.'])->withInput();
        // }

        $body['password'] = bcrypt($body['password']);
        $user = User::create($body);
        auth()->guard('web')->login($user);

        return redirect('/dashboard');
    }

    public function logout(Request $request) {
        auth()->guard('web')->logout();
        return redirect('/login');
        
        // // Invalidate the session
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        // // Redirect to Google's logout endpoint with a return URL
        // $googleLogoutUrl = 'https://accounts.google.com/Logout?continue=https://appengine.google.com/_ah/logout?continue=' . urlencode(route('login'));

        // return redirect($googleLogoutUrl);
    }

    public function redirectToGoogleAdmin() {
        $client = new Client();
        $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
        $client->setHttpClient($guzzleClient);

        $client->setClientId(config('google.client_id'));
        $client->setClientSecret(config('google.client_secret'));
        $client->setRedirectUri(config('google.redirect_uri_admin'));

        $client->setScopes(config('google.scopes'));
        $client->setAccessType('offline'); // ensures refresh_token is returned
        $client->setPrompt('consent');     // forces showing the consent screen
        $client->setIncludeGrantedScopes(true);

        $url = $client->createAuthUrl();
        return redirect($url);
    }

    public function handleGoogleCallbackAdmin(Request $request) {
        $client = new Client();
        $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
        $client->setHttpClient($guzzleClient);

        $client->setClientId(config('google.client_id'));
        $client->setClientSecret(config('google.client_secret'));
        $client->setRedirectUri(config('google.redirect_uri_admin'));

        $token = $client->fetchAccessTokenWithAuthCode(request('code'));

        if (isset($token['error'])) {
            return redirect()->route('error.page')->with('error', $token['error_description']);
        }

        // Save tokens (at least the refresh_token) for admin
        GoogleToken::updateOrInsert(
            ['user_identifier' => 'admin'],
            [
                'access_token' => $token['access_token'],
                'refresh_token' => $token['refresh_token'] ?? null,
                'expires_in' => $token['expires_in'],
            ]
        );

        return redirect()->route('dashboard')->with('success', 'Google Calendar connected!');
    }
}