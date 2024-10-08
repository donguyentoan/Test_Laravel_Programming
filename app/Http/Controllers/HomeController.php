<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $product = Product::where("is_active" , 1)->get();
        return view('customer.home.index' , ["products" => $product]);
    } 
    public function detail($id){
        return view('customer.home.detailProduct');
    }
}
