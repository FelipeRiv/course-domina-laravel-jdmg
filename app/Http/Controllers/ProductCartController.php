<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ProductCartController extends Controller
{
    public $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
        // dd($this->cartService);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        // $cart = Cart::create();
        // $cart = $this->getFromCookieOrCreate();
        $cart = $this->cartService->getFromCookieOrCreate();

        $quantity = $cart->products()
            ->find($product->id)
            ->pivot // has the fk and the quantity
            ->quantity ?? 0;

        // if ($product->stock < $quantity + 1) {
        //     throw ValidationException::withMessages([
        //         'product' => "There is not enough stock for the quantity you required of {$product->title}",
        //     ]);
        // }

        // $cart->products()->attach([ // attach gives problems adding same product with different quantities 
            // $product->id => ['quantity' => $quantity + 1],
        // ]);

        // $cart->products()->sync([ // sync verifies if exists and add it - but removes the rest 
        //     $product->id => ['quantity' => $quantity + 1],
        // ]);

        $cart->products()->syncWithoutDetaching([ // * adds them but without delete them
            $product->id => ['quantity' => $quantity + 1],
        ]);

        // $cart->touch();

        // $cookie = cookie()->make('cart', $cart->id, 7 * 24 * 60); // minutes
        $cookie = Cookie::make('cart', $cart->id, 7 * 24 * 60); // minutes - facade
        // $cookie = $this->cartService->makeCookie($cart);

        // return redirect()->back();
        return redirect()->back()->cookie($cookie);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Cart $cart)
    {
        //
    }

    // public function getFromCookieOrCreate()
    // {
    //     // $cartId = cookie()->get('cart');
    //     $cartId = Cookie::get('cart'); // facade
        
    //     $cart = Cart::find( $cartId);

    //     return $cart ?? Cart::create();
    // }

}
