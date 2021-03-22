<?php

namespace App\Http\CustomClass;

use Ixudra\Curl\Facades\Curl;

class KomojuApi
{
    public static function sessionGet($sessionId)
    {
        $response = Curl::to(env('KOMOJU_API_URL').'sessions/'.$sessionId)
        ->withAuthorization('Basic '.base64_encode(env('KOMOJU_CLIENT_SECRET')))
        ->asJson()
        ->get();
        return $response;
    }

    public static function hostedPage($row)
    {
        $params = array(
            'email' => $row['email'], 
            'amount' => $row['price'],
            'currency' => 'JPY',
            'payment_data' => array(
                'external_order_num' => $row['external_order_num'],
                'name' => $row['name']
            ),
            'return_url' => env('KOMOJU_REDIRECT_URI')
        );
        $response = Curl::to(env('KOMOJU_API_URL').'sessions')
        ->withAuthorization('Basic '.base64_encode(env('KOMOJU_CLIENT_SECRET')))
        ->withData($params)
        ->asJson()
        ->post();
        return $response;
    }
}