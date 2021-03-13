<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OAuthController extends Controller
{
    public function redirect(Request $request)
    {
        $request->session()->put('state', $state = Str::random(40));

        $query = http_build_query([
            'client_id' => '4',
            'redirect_uri' => 'http://localhost:8001/oauth/callback',
            'response_type' => 'code',
            'scope' => 'user.email',
            'state' => $state,
        ]);

        return redirect('http://localhost:8001/oauth/authorize?'.$query);
    }

    public function callback(Request $request)
    {
        $state = $request->session()->pull('state');

        $codeVerifier = $request->session()->pull('code_verifier');

        throw_unless(
            strlen($state) > 0 && $state === $request->state,
            \InvalidArgumentException::class
        );

        $http = new \GuzzleHttp\Client();

        $response = $http->post('http://servicetime_nginx_1/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => '4',
                'client_secret' => 'h5JYLAGKWpaUqBzbCkgDJi38RQFu7ilGPE6W08Qd',
                'redirect_uri' => 'http://localhost:8001/oauth/callback',
                'code_verifier' => $codeVerifier,
                'code' => $request->code,
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }
}
