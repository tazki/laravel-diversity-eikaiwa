<?php

namespace App\Http\CustomClass;

use Ixudra\Curl\Facades\Curl;

class KomojuApi
{
    public static function createCustomer($row)
    {
        $params = array(
            'email' => $row['email'], 
            'payment_details' => $row['komojuToken']
            // 'payment_details' => array(
                // 'family_name' => $row['last_name'],
                // 'given_name' => $row['first_name'],
                // 'month' => $row['month'],
                // 'year' => $row['year'],
                // 'number' => $row['number'],
                // 'type' => 'credit_card'
            // )
        );
        $response = Curl::to(env('KOMOJU_API_URL').'customers')
        ->withAuthorization('Basic '.base64_encode(env('KOMOJU_CLIENT_SECRET')))
        ->withData($params)
        ->asJson()
        ->post();
        return $response;

        // Return Data
        // stdClass Object
        // (
        //     [id] => 0dhe3f3tpbmycl1gvev64jv9y
        //     [resource] => customer
        //     [email] => 
        //     [source] => stdClass Object
        //         (
        //             [type] => credit_card
        //             [brand] => visa
        //             [last_four_digits] => 1111
        //             [month] => 3
        //             [year] => 2026
        //         )

        //     [metadata] => stdClass Object
        //         (
        //         )

        //     [created_at] => 2021-03-30T04:51:15Z
        // )
    }

    public static function createSubscriptions($row)
    {
        $params = array(
            'customer' => $row['customer_id'],
            'amount' => $row['amount'],
            'currency' => 'JPY',
            'period' => 'monthly'
        );
        $response = Curl::to(env('KOMOJU_API_URL').'subscriptions')
        ->withAuthorization('Basic '.base64_encode(env('KOMOJU_CLIENT_SECRET')))
        ->withData($params)
        ->asJson()
        ->post();
        return $response;

        // Return Data
        // stdClass Object
        // (
        //     [id] => 2o33ibwklud6rt9x9t7dxyiv6
        //     [resource] => subscription
        //     [status] => active
        //     [amount] => 26
        //     [currency] => JPY
        //     [customer] => stdClass Object
        //         (
        //             [id] => 135690
        //             [uuid] => 0dhe3f3tpbmycl1gvev64jv9y
        //             [merchant_id] => 13867
        //             [created_at] => 2021-03-30T13:51:15.523+09:00
        //             [updated_at] => 2021-03-30T13:51:15.523+09:00
        //             [email] => 
        //             [currency] => JPY
        //             [metadata] => stdClass Object
        //                 (
        //                 )

        //         )

        //     [period] => monthly
        //     [day] => 30
        //     [payment_details] => stdClass Object
        //         (
        //             [type] => credit_card
        //             [year] => 2026
        //             [month] => 3
        //             [family_name] => Bautista
        //             [given_name] => Mark
        //             [email] => tazki04@gmail.com
        //         )

        //     [retry_count] => 0
        //     [retry_at] => 
        //     [next_capture_at] => 2021-04-30T04:51:16Z
        //     [created_at] => 2021-03-30T04:51:16Z
        //     [ended_at] => 
        //     [metadata] => stdClass Object
        //         (
        //         )

        //     [payments] => Array
        //         (
        //             [0] => 1dthpe02si0dsqfbq6h433zgj
        //         )

        // )
    }

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