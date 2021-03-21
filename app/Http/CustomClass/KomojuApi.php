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
        // $responseObject = json_decode($response);
        // pr($responseObject);
    }

    public static function hostedPage($row)
    {
        $params = array(
            'email' => $row['email'], 
            'amount' => $row['price'],
            'currency' => 'JPY',
            // 'metadata' => array('id' => $row['id']),
            'payment_data' => array(
                'external_order_num' => $row['external_order_num'],
                'name' => $row['name']
            ),
            'return_url' => env('KOMOJU_REDIRECT_URI')
        );
        // pr($params);
        // curl -u secret_key: "https://komoju.com/api/v1/payments"
        // $response = Curl::to(env('KOMOJU_API_URL').'payments')
        // curl -X POST https://komoju.com/api/v1/sessions \
        //     -u sk_123456: \
        //     -d "default_locale=ja" \
        //     -d "email=test@example.com" \
        //     -d "metadata[test]=value" \
        //     -d "amount=8888" \
        //     -d "currency=JPY" \
        //     -d "payment_data[external_order_num]=my_custom_order" \
        //     -d "payment_data[name]=John" \
        //     -d "payment_data[name_kana]=ジョン" \
        //     -d "payment_types[]=credit_card" \
        //     -d "payment_types[]=konbini" \
        //     -d "return_url=https://example.com" 
        $response = Curl::to(env('KOMOJU_API_URL').'sessions')
        ->withAuthorization('Basic '.base64_encode(env('KOMOJU_CLIENT_SECRET')))
        // ->withHeaders( array( 'sk_12345: '.env('KOMOJU_CLIENT_SECRET') ) )
        // ->withBearer(env('KOMOJU_CLIENT_SECRET'))
        ->withData($params)
        ->asJson()
        ->post();
        // pr($response);
        return $response;
        // $responseObject = json_decode($response);
        // pr($responseObject);
    }
}