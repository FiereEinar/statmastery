<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Google\Client;
use Google\Service\Oauth2;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class GoogleCalendarController extends Controller
{
    public function redirectToGoogle()
    {
        $client = new Client();
        $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
        $client->setHttpClient($guzzleClient);
        $client->setClientId(config('google.client_id'));
        $client->setClientSecret(config('google.client_secret'));
        $client->setRedirectUri(config('google.redirect_uri'));
        $client->setScopes(config('google.scopes'));
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        return redirect($client->createAuthUrl());
    }
    
    public function handleGoogleCallback(Request $request)
    {
        $client = new Client();
        $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
        
        $client->setHttpClient($guzzleClient);
        $client->setClientId(config('google.client_id'));
        $client->setClientSecret(config(key: 'google.client_secret'));
        $client->setRedirectUri(config('google.redirect_uri'));
        
        $token = $client->fetchAccessTokenWithAuthCode(request('code'));
        
        if (isset($token['error'])) {
            return redirect('/login')->withErrors(['google' => 'Failed to authenticate with Google.']);
        }
        
        // dd($token);
        
        Session::put('google_token', $token);
        $client->setAccessToken($token['access_token']);
        // dd(Session::get('google_token'));
        
        // Get user info from Google
        $oauth = new Oauth2($client);
        $googleUser = $oauth->userinfo->get();

        // Find or create local user
        $user = User::firstOrCreate(
            ['email' => $googleUser->email],
            ['name' => $googleUser->name, 'email' => $googleUser->email, 'password' => bcrypt(uniqid())]
        );

        // Log in the user
        auth()->guard('web')->login($user);

        // Regenerate session
        $request->session()->regenerate();

        return redirect('/dashboard');
    }
}