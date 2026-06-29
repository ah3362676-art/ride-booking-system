<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\TripPassenger;
use App\Services\PaymobService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(
        protected PaymobService $paymobService
    ) {}

    // بدء الدفع
public function pay(TripPassenger $tripPassenger)
{
    abort_if($tripPassenger->payment_status === 'paid', 403);

    $user = $tripPassenger->user;


    $url = $this->paymobService->pay($tripPassenger);

    return redirect($url);
}

    // callback (redirect فقط)
    public function callback()
    {
        return redirect()
            ->route('my-trips');
    }

    // webhook (التأكيد الحقيقي)
    public function webhook(Request $request)
    {
        $data = $request->all();

        $id = data_get($data, 'obj.order.merchant_order_id');
        $success = data_get($data, 'obj.success', false);

        if (!$id || $success !== true) {
            return response()->json(['error' => true], 400);
        }

        $tripPassenger = TripPassenger::find($id);

        if (!$tripPassenger) {
            return response()->json(['error' => 'not found'], 404);
        }

        $tripPassenger->update([
            'payment_status' => 'paid',
            'transaction_id' => data_get($data, 'obj.id')
        ]);

        return response()->json(['success' => true]);
    }


    public function wallet(Request $request, TripPassenger $tripPassenger)
{
    abort_if($tripPassenger->payment_status === 'paid', 403);

    $request->validate([
        'phone' => ['required', 'regex:/^01[0125][0-9]{8}$/'],
    ]);

    $response = $this->paymobService->wallet(
        $tripPassenger,
        $request->phone
    );

    if (isset($response['redirect_url'])) {
        return redirect($response['redirect_url']);
    }

    return back()->withErrors([
        'payment' => $response['message'] ?? 'Wallet payment failed.'
    ]);
}

public function success(Request $request)
{
    // بيانات Paymob بيرجعها هنا
    $data = $request->all();

    // مثال بسيط للتجربة
    return response()->json([
        'message' => 'Payment Success',
        'data' => $data
    ]);
}



}
