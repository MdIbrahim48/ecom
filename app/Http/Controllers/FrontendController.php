<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // function frontend(){
    //     return view('frontend.main');
    // }
    function frontend(){
        return view('frontend.main',[
            'latest_products' => Product::with('category')->latest()->get()
        ]);
    }

    function singleProduct($slug){
        return view('frontend.product_details',[
            'product' => Product::where('slug',$slug)->first()
        ]);
    }

    function shop(){
        return view('frontend.pages.shop',[
            'categories' => Category::orderBy('category_name','asc')->get(),
            'products' => Product::with('category')->latest()->get()
        ]);
    }

}
