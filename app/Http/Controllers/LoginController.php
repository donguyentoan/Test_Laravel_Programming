<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    protected $userService;
    protected $authorValidation;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
      
    }
    public function login()
    {
        return view( 'customer.author.login' );
    }
    public function loginUser(Request $request)
    {
        $credentials = $request->only( 'email', 'password' );
        if ( Auth::attempt( $credentials ) ) {
            if ( auth()->check() ) {
                if ( auth()->user()->isAdmin() ) {
                    return redirect()->route( 'dashboard' );

                } else {
                    return redirect( '/' );

                }
            }

        }
        return redirect()->back()->withInput( $request->only( 'email', 'password' ) )->withErrors( [
            'password' => 'Địa chị email hoặc mật khẩu không chính xác.',
        ] );
    }
    public function logout()
    {
        Auth::logout();
        return redirect( '/login' );
    }
}
