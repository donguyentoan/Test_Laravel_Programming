<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        return view('customer.home.index');
    } 
    public function detail($id){
        return view('customer.home.detailProduct');
    }
}
