<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
        // dd($cartService);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('carts.index')->with([
            'cart' => $this->cartService->getFromCookie(),
            // 'cart' => $this->cartService->getFromCookieOrCreate(),
        ]);
    }


}
