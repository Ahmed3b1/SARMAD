<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cart;
use App\Models\cartitem;
use App\Models\order;
use App\Models\orderitem;
use App\Models\product;

class CheckoutController extends Controller
{

    public function buyNow(Request $request, $productId)
    {
        $product = product::findOrFail($productId);

        $sessionId = session()->getId();

        $quantity = max(1, (int) $request->quantity);

        /*
        |--------------------------------------------------------------------------
        | Create/Get Cart
        |--------------------------------------------------------------------------
        */

        $cart = cart::firstOrCreate([
            'session_id' => $sessionId
        ]);

        /*
        |--------------------------------------------------------------------------
        | Clear Current Cart
        |--------------------------------------------------------------------------
        | Buy Now should contain only this product.
        */

        cartitem::where('cart_id', $cart->id)->delete();

        /*
        |--------------------------------------------------------------------------
        | Add Selected Product
        |--------------------------------------------------------------------------
        */

        cartitem::create([

            'cart_id' => $cart->id,

            'product_id' => $product->id,

            'quantity' => $quantity

        ]);

        /*
        |--------------------------------------------------------------------------
        | Redirect To Checkout
        |--------------------------------------------------------------------------
        */

        return redirect()->route('checkout');
    }


    public function checkout()
    {
        $sessionId = session()->getId();

        $cart = cart::where( 'session_id', $sessionId )->first();

        if(!$cart)
        {
            return redirect()->route('cart');
        }

        $cartItems = cartitem::with('product')->where('cart_id',$cart->id)->get();

        if($cartItems->count() == 0)
        {
            return redirect()->route('cart');
        }

        $subtotal = $cartItems->sum(function($item){

            return $item->quantity * $item->product->price;

        });

        $shipping = 50;

        $total = $subtotal + $shipping;

        // في الـ controller اللي بيعمل return للـ checkout view
        $paymentMethods = [
            ['key' => 'card', 'label' => 'فيزا / ماستركارد', 'icon' => 'card'],
            ['key' => 'wallet', 'label' => 'محفظة موبايل (فودافون كاش / أورانج كاش / اتصالات كاش)', 'icon' => 'wallet'],
        ];

        return view('checkout',[

            'cartItems' => $cartItems,

            'subtotal' => $subtotal,

            'shipping' => $shipping,

            'total' => $total,

            'paymentMethods' => $paymentMethods

        ]);
    }

    public function placeOrder(Request $request)
    {
        $request->validate([

            'name' => 'required|max:255',
            'address' => 'required',
            'phone' => 'required|max:30',
            'additional_phone' => 'nullable|max:30',
            'note' => 'nullable',
            'payment_method' => 'required'

        ]);

        $sessionId = session()->getId();

        $cart = cart::where( 'session_id', $sessionId )->first();

        if(!$cart)
        {
            return redirect()->route('cart')->with('error', 'Cart is empty.' );
        }

        $cartItems = cartitem::with('product')->where( 'cart_id', $cart->id )->get();

        if($cartItems->count() == 0)
        {
            return redirect()->route('cart')->with( 'error', 'Cart is empty.' );
        }

        $subtotal = $cartItems->sum(function($item){

            return $item->quantity * $item->product->price;

        });

        $shipping = 50;

        $total = $subtotal + $shipping;

        /*
        |--------------------------------------------------------------------------
        | Create Order
        |--------------------------------------------------------------------------
        */

        $order = order::create([

            'name' => $request->name,

            'address' => $request->address,

            'phone' => $request->phone,

            'additional_phone' => $request->additional_phone,

            'note' => $request->note,

            'subtotal' => $subtotal,

            'shipping_cost' => $shipping,

            'total' => $total,

            'payment_method' => $request->payment_method,

            'status' => 'pending',

            // 'cart_id' => $cart->id,   

            'session_id' => session()->getId()

        ]);

        /*
        |--------------------------------------------------------------------------
        | Create Order Items
        |--------------------------------------------------------------------------
        */

        foreach($cartItems as $item)
        {
            orderitem::create([

                'order_id' => $order->id,

                'product_id' => $item->product_id,

                'quantity' => $item->quantity,

                'price' => $item->product->price,

                'total' => $item->quantity * $item->product->price

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Save Order In Session
        |--------------------------------------------------------------------------
        */

        session([

            'current_order_id' => $order->id

        ]);

        /*
        |--------------------------------------------------------------------------
        | Go To Paymob
        |--------------------------------------------------------------------------
        */

        return redirect()->route('paymob.pay');
    }

}
