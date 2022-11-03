<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductCartController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @param  \App\Models\Product  $product
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index(Product $product)
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @param  \App\Models\Product  $product
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create(Product $product)
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        // $cart = $this->cartService->getFromCookieOrCreate();
        $cart = Cart::create();

        $quantity = $cart->products()
            ->find($product->id)
            ->pivot // has the fk and the quantity
            ->quantity ?? 0;

        // if ($product->stock < $quantity + 1) {
        //     throw ValidationException::withMessages([
        //         'product' => "There is not enough stock for the quantity you required of {$product->title}",
        //     ]);
        // }

        $cart->products()->attach([
            $product->id => ['quantity' => $quantity + 1],
        ]);

        // $cart->products()->syncWithoutDetaching([
        //     $product->id => ['quantity' => $quantity + 1],
        // ]);

        // $cart->touch();

        // $cookie = $this->cartService->makeCookie($cart);

        return redirect()->back();
        // return redirect()->back()->cookie($cookie);
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Product  $product
    //  * @param  \App\Models\Cart  $cart
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Product $product, Cart $cart)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Product  $product
    //  * @param  \App\Models\Cart  $cart
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Product $product, Cart $cart)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Product  $product
    //  * @param  \App\Models\Cart  $cart
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Product $product, Cart $cart)
    // {
    //     //
    // }

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
}
