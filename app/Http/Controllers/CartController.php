<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    // function cart(Request $request){
    //     $minutes = 43200;
    //     $cookie_id = Str::random(10);
    //     Cookie::queue('cookie_id',$cookie_id,$minutes);
    //     return $request->cookie('ecom');
    // }

    function singleCart($slug){
        $minutes = 43200;
        $cookie_id = Str::random(10);
        Cookie::queue('cookie_id',$cookie_id,$minutes);

        $product_id = Product::where('slug',$slug)->first()->id;
        $cart = new Cart;
        $cart->cookie_id = $cookie_id;
        $cart->product_id = $product_id;
        $cart->save();
        return back();
    }
}
