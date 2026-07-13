<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\cartitem;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Productphoto;
use App\Models\Category;

class MainController extends Controller
{

    public function home() {

        $products = Product::all() ;
        $watches = Product::where('category_id' , 1 )->get() ;
        $perfumes = Product::where('category_id' , 2 )->get() ;
        $categories = Category::all() ;

        return view('home' , [ 'products' => $products , 'watches' => $watches , 'perfumes' => $perfumes , 'categories' => $categories ]);

    }

    public function watches()
    {
        $category = category::where('id', 1)->first();

        $subcategories = $category
            ? $category->subcategories()
                ->orderBy('sort_order')
                ->with(['products' => function ($query) {
                    $query->where('category_id', 1)
                          ->latest()
                          ->take(8);
                }])
                ->get()
                ->filter(function ($subcategory) {
                    return $subcategory->products->count() > 0;
                })
            : collect();

        return view('watches', compact('subcategories'));
    }

    public function perfumes()
    {
        $category = category::where('id', 2)->first();

        $subcategories = $category
            ? $category->subcategories()
                ->orderBy('sort_order')
                ->with(['products' => function ($query) {
                    $query->where('category_id', 2)
                          ->latest()
                          ->take(8);
                }])
                ->get()
                ->filter(function ($subcategory) {
                    return $subcategory->products->count() > 0;
                })
            : collect();

        return view('perfumes', compact('subcategories'));
    }

    public function product($productid) {

        $productphotos = Productphoto::where( 'product_id' , $productid )->get() ;
        $product = Product::find($productid) ;

        return view('product' , [ 'productphotos' => $productphotos , 'product' => $product ]);

    }

    public function cart()
    {
        $sessionId = session()->getId();

        $cart = Cart::where('session_id',$sessionId)->first();

        if(!$cart)
        {
            return view('cart', [
                                'cart' => null,
                                'cartItems' => collect(),
                                'count' => 0,
                                'subtotal' => 0,
                                'total' => 0
                            ]);
        }

        $cartItems = Cartitem::with('product')->where('cart_id', $cart->id)->get();

        $count = $cartItems->sum('quantity');

        $subtotal = $cartItems->sum(function($item){

            return $item->quantity * $item->product->price;

        });

        $shipping = 50;

        $total = $subtotal + $shipping;

        return view('cart',[
                            'cart' => $cart,
                            'cartItems' => $cartItems,
                            'count' => $count,
                            'subtotal' => $subtotal,
                            'shipping' => $shipping,
                            'total' => $total
        ]);
    }

    public function addToCart( Request $request, $productid )
    {
        $product = Product::findOrFail($productid);

        $sessionId = session()->getId();

        $cart = Cart::firstOrCreate([

            'session_id' => $sessionId

        ]);

        $quantity = $request->quantity ?? 1;

        $cartItem = Cartitem::where('cart_id', $cart->id )->where('product_id', $productid )->first();

        if($cartItem)
        {
            $cartItem->quantity += $quantity;

            $cartItem->save();
        }
        else
        {
            Cartitem::create([

                'cart_id' => $cart->id,

                'product_id' => $productid,

                'quantity' => $quantity

            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully.' );
    }


    public function updateCart(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = cartitem::with('product')->findOrFail($id);

        // تحديث الكمية
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        // الحصول على السلة
        $cart = cart::findOrFail($cartItem->cart_id);

        // جميع عناصر السلة
        $cartItems = cartitem::with('product')
            ->where('cart_id', $cart->id)
            ->get();

        $count = $cartItems->sum('quantity');

        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        $shipping = 50;

        $total = $subtotal + $shipping;

        return response()->json([

            'success' => true,

            'count' => $count,

            'subtotal' => number_format($subtotal),

            'shipping' => number_format($shipping),

            'total' => number_format($total),

            'itemTotal' => number_format(
                $cartItem->quantity * $cartItem->product->price
            )
        ]);
    }


    public function deleteCartItem($id)
    {
        $cartItem = cartitem::findOrFail($id);

        $cartId = $cartItem->cart_id;

        $cartItem->delete();

        $cartItems = cartitem::with('product')
                    ->where('cart_id', $cartId)
                    ->get();

        $count = $cartItems->sum('quantity');

        $subtotal = $cartItems->sum(function ($item) {

            return $item->quantity * $item->product->price;

        });

        $shipping = $count > 0 ? 50 : 0;

        $total = $subtotal + $shipping;

        if ($count == 0) {

            cart::where('id', $cartId)->delete();

        }

        return response()->json([

            'success' => true,

            'count' => $count,

            'subtotal' => number_format($subtotal),

            'shipping' => number_format($shipping),

            'total' => number_format($total)

        ]);
    }

}
