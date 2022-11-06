<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;

class CartService
{
    protected $cookieName = 'cart';
    protected $cookieExpiration = 7 * 24 * 60; // minutes - facade;

    // public function __construct()
    // {
    //     $this->cookieName = config('cart.cookie.name');
    //     $this->cookieExpiration = config('cart.cookie.expiration');
    // }

    // public function getFromCookie()
    // {
    //     $cartId = Cookie::get($this->cookieName);

    //     $cart = Cart::find($cartId);

    //     return $cart;
    // }

    public function getFromCookieOrCreate()
    {
        // $cartId = cookie()->get('cart');
        // $cartId = Cookie::get('cart'); // facade
        $cartId = Cookie::get($this->cookieName); // facade
        
        $cart = Cart::find( $cartId);

        return $cart ?? Cart::create();
    }

    // public function getFromCookieOrCreate()
    // {
    //     $cart = $this->getFromCookie();

    //     return $cart ?? Cart::create();
    // }

    public function makeCookie(Cart $cart)
    {
        return Cookie::make($this->cookieName, $cart->id, $this->cookieExpiration);
        // return Cookie::make($this->cookieName, $cart->id, $this->cookieExpiration);

    }

    // public function countProducts()
    // {
    //     $cart = $this->getFromCookie();

    //     if ($cart != null) {
    //         return $cart->products->pluck('pivot.quantity')->sum();
    //     }

    //     return 0;
    // }
}