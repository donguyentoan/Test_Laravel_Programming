<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Validation\AuthorValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller {

    protected $userService;
    protected $authorValidation;

    public function __construct( UserService $userService, AuthorValidation $authorValidation )
    {
        $this->userService = $userService;
        $this->authorValidation = $authorValidation;
    }

    public function register()
    {
        return view( 'customer.author.register' );
    }

    public function createUser(Request $request )
    {
        $data = $request->all();
        if ( $data[ 'password' ] == $request->input( 'cpassword' ) ) {
            $data = [
                'name' =>$data[ 'name' ],
                'email' => $data[ 'email' ] ?? null,
                'phone' => $data[ 'phone' ],
                'password' => Hash::make( $data[ 'password' ] ),
            ];
            $user = $this->userService->create( $data );
            Auth::login( $user );
            return redirect( '/' )->with( 'success', 'You have been redirected!' );
        } else {
            return redirect( '/register' )->with( 'error', 'password and Confirm Password not fit' );
        }
    }
}
