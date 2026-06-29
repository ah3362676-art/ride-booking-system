<?php

namespace App\Services;

use App\Models\TripPassenger;

use Illuminate\Support\Facades\Http;

class PaymobService
{
    public function authenticate()
    {
        $response = Http::post(
            'https://accept.paymob.com/api/auth/tokens',
            [
                'api_key' => config('services.paymob.api_key'),
            ]
        );

        return $response->json()['token'];
    }

    public function createOrder( float $amount, int $tripPassengerId) {
        $token = $this->authenticate();

        $response = Http::post(
            'https://accept.paymob.com/api/ecommerce/orders',
            [
                'auth_token' => $token,
                'delivery_needed' => false,
                'amount_cents' => (int) ($amount * 100),
                'currency' => 'EGP',
                'merchant_order_id' => $tripPassengerId,
                'items' => [],
            ]
        );

        return $response->json();
    }

    public function generatePaymentKey(TripPassenger $tripPassenger,$user,int $integrationId) {

        $token = $this->authenticate();

        $order = $this->createOrder(
            $tripPassenger->total_price,
            $tripPassenger->id
        );

        $response = Http::post(
            'https://accept.paymob.com/api/acceptance/payment_keys',
            [
                'auth_token' => $token,

                'amount_cents' => (int) ($tripPassenger->total_price * 100),

                'expiration' => 3600,

                'order_id' => $order['id'],

                'billing_data' => [
                    'first_name' => $user->name,
                    'last_name' => 'User',
                    'email' => $user->email,
                    'phone_number' => $user->phone ?? '+201000000000',

                    'apartment' => 'NA',
                    'floor' => 'NA',
                    'street' => 'NA',
                    'building' => 'NA',
                    'shipping_method' => 'NA',
                    'postal_code' => '12345',
                    'city' => 'Cairo',
                    'country' => 'EG',
                    'state' => 'Cairo',
                ],

                'currency' => 'EGP',

            'integration_id' => $integrationId,            ]
        );

        return $response->json();
    }

    public function getPaymentUrl( TripPassenger $tripPassenger, $user ) {
        $paymentKey = $this->generatePaymentKey(
            $tripPassenger,
            $user,
            config('services.paymob.integration_id')
        );

        return 'https://accept.paymob.com/api/acceptance/iframes/'
            . config('services.paymob.iframe_id')
            . '?payment_token='
            . $paymentKey['token'];
    }



public function pay(TripPassenger $tripPassenger) {
    return $this->getPaymentUrl(
        $tripPassenger,
        $tripPassenger->user
    );
}


public function payWithWallet( TripPassenger $tripPassenger, $user, string $phone)
 {
    $paymentKey = $this->generatePaymentKey(
        $tripPassenger,
        $user,
        config('services.paymob.wallet_integration_id')
    );

    $response = Http::post(
        'https://accept.paymob.com/api/acceptance/payments/pay',
        [
            'source' => [
                'identifier' => $phone,
                'subtype' => 'WALLET',
            ],

            'payment_token' => $paymentKey['token'],
        ]
    );

    return $response->json();
}

public function wallet(TripPassenger $tripPassenger, string $phone)
{
    return $this->payWithWallet(
        $tripPassenger,
        $tripPassenger->user,
        $phone
    );
}

}
