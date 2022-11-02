<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){

        // * without scope
        // $products = Product::where('status', 'available')->get();
        
        // * with scope - the name of the scope is scopeAvailable it is used as available and its in its model
        $products = Product::available()->get();

        return view('welcome')->with([
            // 'products' => Product::all()
            'products' => $products,
        ]);
    }
}
