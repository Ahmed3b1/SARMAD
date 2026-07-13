<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Services\PaymobService;
use App\Models\order;
use App\Models\cart;
use App\Models\cartitem;

class PaymentController extends Controller
{
    // public function pay(PaymobService $paymob)
    // {

    //     $orderId = session('current_order_id');

    //     $order = order::findOrFail($orderId);

    //     $amount = $order->total;

    //     // 2. paymob flow

    //     $token = $paymob->auth();
    //     $paymobOrderId = $paymob->createOrder($token, $amount);
    //     $paymentToken = $paymob->paymentKey($token, $paymobOrderId, $amount , $order );

    //     // 3. save external id

    //     $order->update([
    //         'paymob_order_id' => $paymobOrderId
    //     ]);

    //     // 4. redirect
    //     $iframeId = config('services.paymob.iframe_id');

    //     return redirect("https://accept.paymob.com/api/acceptance/iframes/$iframeId?payment_token=$paymentToken");
    // }


    public function pay(PaymobService $paymob)
    {
        $orderId = session('current_order_id');
        $order = Order::findOrFail($orderId);

        $intention = $paymob->createIntention($order, $order->payment_method);

        $order->update([
            'paymob_order_id' => $intention['intention_order_id'] ?? null,
            'paymob_client_secret' => $intention['client_secret'],
        ]);

        return view('pay', [
            'clientSecret' => $intention['client_secret'],
            'publicKey' => config('services.paymob.public_key'),
            'paymentMethod' => $order->payment_method,
        ]);
    }

    private function verifyHmac(Request $request)
    {
        $secret = config('services.paymob.hmac_secret');
        $receivedHmac = $request->query('hmac');

        $obj = $request->input('obj');

        // الـ fields بالترتيب الصح اللي Paymob بيحدده
        $fields = [
            'amount_cents',
            'created_at',
            'currency',
            'error_occured',
            'has_parent_transaction',
            'id',
            'integration_id',
            'is_3d_secure',
            'is_auth',
            'is_capture',
            'is_refunded',
            'is_standalone_payment',
            'is_voided',
            'order.id',
            'owner',
            'pending',
            'source_data.pan',
            'source_data.sub_type',
            'source_data.type',
            'success',
        ];

        $hashString = '';

        foreach ($fields as $field) {
            // لو فيه نقطة يعني nested field
            if (str_contains($field, '.')) {
                [$parent, $child] = explode('.', $field);
                $value = $obj[$parent][$child] ?? '';
            } else {
                $value = $obj[$field] ?? '';
            }

            // Paymob بيحول true/false لـ string
            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }

            $hashString .= $value;
        }

        $calculatedHmac = hash_hmac('sha512', $hashString, $secret);

        // للـ debugging
        Log::info('HMAC DEBUG', [
            'hash_string' => $hashString,
            'calculated'  => $calculatedHmac,
            'received'    => $receivedHmac,
            'match'       => hash_equals($calculatedHmac, $receivedHmac),
        ]);

        return hash_equals($calculatedHmac, $receivedHmac);
    }

    public function webhook(Request $request)
    {
        Log::info('Webhook Hit', $request->all());

        if (!$this->verifyHmac($request)) {
            Log::warning('Invalid HMAC');
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $data = $request->all();

        $success = $data['obj']['success'] ?? false;
        $orderId = $data['obj']['order']['id'] ?? null;

        $order = Order::where('paymob_order_id', $orderId)->first();

        $cart = cart::where('session_id' , $order->session_id)->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found']);
        }

        if ($success) {
            $order->update([
                'status' => 'paid',
                'paid_at' => now(),
                'payment_method' => 'paymob'
            ]);

            if($cart) {

                cartitem::where('cart_id', $cart->id )->delete();
            }
        } else {
            $order->update(['status' => 'failed']);
        }

        return response()->json(['ok'], 200);
    }



    public function returnFromPaymob(Request $request)
    {
        $success = $request->query('success') === 'true';

        // if ($success) {
        //     return redirect()->route('order.success')->with('message', 'تم الدفع بنجاح');
        // }

        // return redirect()->route('order.failed')->with('error', 'فشلت عملية الدفع');

        return view('breakout', ['redirectTo' => $success ? route('order.success') : route('order.failed'), ]);
    }

    public function success(Request $request)
    {
        return view('ordersuccess');
    }


    public function failed()
    {
        return view('orderfailed');
    }

}
