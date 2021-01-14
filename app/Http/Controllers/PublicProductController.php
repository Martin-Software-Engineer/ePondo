<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PublicProductController extends Controller
{
    public function index(){
        
        $products = Product::paginate(5);
        
        return view ('public.products.index',['products' => $products]);
    }

    public function show($product_id){
        
        $product = Product::where('id',$product_id)->first();
        
        return view('public.products.show', compact('product'));
    }
}
