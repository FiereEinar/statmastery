<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GoogleToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Google\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

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
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (auth()->guard('web')->attempt(['email' => $body['email'], 'password'=> $body['password']])) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        } else {
            return back()->withErrors(['all' => 'Incorrect credentials'])->withInput();
        }
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
            // 'confirmPassword' => ['required', 'min:3', 'max:255'],
        ]);

        // if ($body['password'] !== $body['confirmPassword']) {
        //     return back()->withErrors(['all' => 'Passwords do not match'])->withInput();
        // }

        $body['password'] = bcrypt($body['password']);
        $user = User::create($body);
        auth()->guard('web')->login($user);

        return redirect('/dashboard');
    }

    public function logout() {
        auth()->guard('web')->logout();
        return redirect('/login');
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