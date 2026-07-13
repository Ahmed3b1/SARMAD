<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

// class PaymobService
// {
//     private $baseUrl = "https://accept.paymob.com/api";


//     private function firstName($fullName)
//     {
//         return explode(
//             ' ',
//             trim($fullName)
//         )[0];
//     }

//     private function lastName($fullName)
//     {
//         $parts = explode(
//             ' ',
//             trim($fullName)
//         );

//         return count($parts) > 1
//             ? end($parts)
//             : '-';
//     }


//     // public function auth()
//     // {
//     //     $response = Http::post("$this->baseUrl/auth/tokens", [
//     //         "api_key" => config('services.paymob.api_key')
//     //     ]);

//     //     dd($response->json());
//     // }

//     public function auth()
//     {
//         $response = Http::post("https://accept.paymob.com/api/auth/tokens", [
//             "api_key" => config('services.paymob.api_key')
//         ]);


//         $data = $response->json();

//         if (!isset($data['token'])) {
//             throw new \Exception(json_encode($data));
//         }

//         return $data['token'];
//     }

//     public function createOrder($token, $amount)
//     {
//         return Http::post("$this->baseUrl/ecommerce/orders", [
//             "auth_token" => $token,
//             "delivery_needed" => false,
//             "amount_cents" => $amount * 100,
//             "currency" => "EGP",
//             "items" => []
//         ])->json()['id'];
//     }

//     public function paymentKey($token, $orderId, $amount, $order)
//     {
//         return Http::post("$this->baseUrl/acceptance/payment_keys", [
//             "auth_token" => $token,
//             "amount_cents" => $amount * 100,
//             "expiration" => 3600,
//             "order_id" => $orderId,
//             "billing_data" => [
//                 "email"        => "customer@sarmad.com",
//                 "first_name"   => $this->firstName( $order->name ) ,
//                 "last_name"    =>  $this->lastName( $order->name ) ,
//                 "phone_number" => $order->phone,
//                 "city"         => "Egypt",
//                 "country"      => "EG",
//                 "street"       => $order->address,
//                 "building"     => "NA",
//                 "floor"        => "NA",
//                 "apartment"    => "NA"
//             ],
//             "currency" => "EGP",
//             "integration_id" => config('services.paymob.integrations.wallet'),
//         ])->json()['token'];
//     }
// }


class PaymobService
{
    private string $baseUrl = "https://accept.paymob.com/v1/intention/";

    private function firstName($fullName)
    {
        return explode(' ', trim($fullName))[0];
    }

    private function lastName($fullName)
    {
        $parts = explode(' ', trim($fullName));
        return count($parts) > 1 ? end($parts) : '-';
    }

    public function createIntention($order, string $paymentMethodKey)
    {
        $integrationId = config("services.paymob.integrations.$paymentMethodKey");


        if (!$integrationId) {
            throw new \Exception("Unknown or unconfigured payment method: $paymentMethodKey");
        }


        Log::info('Intention Request Payload', [
            'notification_url' => route('paymob.webhook'),
            'redirection_url' => route('paymob.return'),
        ]);
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . config('services.paymob.secret_key'),
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl, [
            "amount" => (int) round($order->total * 100),
            "currency" => "EGP",
            "payment_methods" => [(int) $integrationId],
            "items" => [],
            "billing_data" => [
                "email"        => $order->email ?? "customer@sarmad.com",
                "first_name"   => $this->firstName($order->name),
                "last_name"    => $this->lastName($order->name),
                "phone_number" => $order->phone,
                "city"         => "Egypt",
                "country"      => "EG",
                "street"       => $order->address,
                "building"     => "NA",
                "floor"        => "NA",
                "apartment"    => "NA",
            ],
            "extras" => [
                "order_id" => $order->id,
            ],
            "special_reference" => $order->id . '-' . now()->timestamp,
            "notification_url" => config('services.paymob.webhook_url'),
            "redirection_url"   => config('services.paymob.return_url') ?? route('paymob.return'),
        ]);


        $data = $response->json();

        if (!isset($data['client_secret'])) {
            throw new \Exception(json_encode($data));
        }

        return $data; // فيه client_secret, id, intention_order_id
    }
}
