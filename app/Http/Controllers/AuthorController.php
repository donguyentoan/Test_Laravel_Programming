<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function login(){
        return view('customer.author.login');
    }
    public function register(){
        return view('customer.author.register');
    }
}
