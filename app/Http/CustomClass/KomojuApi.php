<?php

namespace App\Http\CustomClass;

use Ixudra\Curl\Facades\Curl;

class KomojuApi
{
    public static function accessToken()
    {
        $params = array(
        // 'code' => $code,
        // 'grant_type' => 'authorization_code',
        // 'client_id' => env('KOMOJU_CLIENT_ID'),
        'username' => env('KOMOJU_CLIENT_SECRET'),
        'secret_key' => env('KOMOJU_API_URL')
        // 'redirect_uri' => env('KOMOJU_REDIRECT_URI')
        );

        $response = Curl::to(env('KOMOJU_API_URL').'payments')
        ->withData($params)
        ->post();
        $responseObject = json_decode($response);
        pr($responseObject);
    }
}