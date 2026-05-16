<?php

namespace App\Services;

use App\Models\TripPassenger;
use Illuminate\Support\Facades\Http;

class PaymobService
{
    public function pay(TripPassenger $tripPassenger)
    {
        $token = $this->auth();

        $order = $this->createOrder($token, $tripPassenger);

        $paymentKey = $this->paymentKey($token, $order, $tripPassenger);

        return $this->paymentUrl($paymentKey);
    }

    private function auth()
    {
        $response = Http::post(
            'https://accept.paymob.com/api/auth/tokens',
            [
                'api_key' => config('services.paymob.api_key'),
            ]
        );

        return $response->json()['token'];
    }

    private function createOrder($token, TripPassenger $tripPassenger)
    {
        $response = Http::post(
            'https://accept.paymob.com/api/ecommerce/orders',
            [
                'auth_token' => $token,
                'delivery_needed' => false,
                'amount_cents' => $tripPassenger->total_price * 100,
                'currency' => 'EGP',
                'merchant_order_id' => (string) $tripPassenger->id,
                'items' => [],
            ]
        );

return $response->json('id');
 }

    private function paymentKey($token, $orderId, TripPassenger $tripPassenger)
    {
        $response = Http::post(
            'https://accept.paymob.com/api/acceptance/payment_keys',
            [
                'auth_token' => $token,
                'amount_cents' => $tripPassenger->total_price * 100,
                'expiration' => 3600,
                'order_id' => $orderId,

                'billing_data' => [
                    'first_name' => auth()->user()->name,
                    'last_name' => 'User',
                    'email' => auth()->user()->email,
                    'phone_number' => '+201000000000',
                    'city' => 'Cairo',
                    'country' => 'EG',
                    'street' => 'NA',
                    'building' => 'NA',
                    'floor' => 'NA',
                    'apartment' => 'NA',
                    'postal_code' => 'NA',
                    'state' => 'NA',
                    'shipping_method' => 'NA',
                ],

                'currency' => 'EGP',
                'integration_id' => config('services.paymob.integration_id'),

                'redirection_url' => route('paymob.callback'),
            ]
        );

        return $response->json()['token'];
    }

    private function paymentUrl($paymentKey)
    {
        $iframeId = config('services.paymob.iframe_id');

        return "https://accept.paymob.com/api/acceptance/iframes/{$iframeId}?payment_token={$paymentKey}";
    }
}
