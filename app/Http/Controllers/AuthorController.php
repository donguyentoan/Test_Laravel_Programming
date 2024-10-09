<?php

namespace App\Http\Controllers;



use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Validation\AuthorValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AuthorController extends Controller
{
    protected $userService;
    protected $authorValidation;
    public function __construct(UserService $userService , AuthorValidation $authorValidation )
    {
        $this->userService = $userService;
        $this->authorValidation = $authorValidation;
      
    }

    public function login(){
        return view('customer.author.login');
    }
    public function register(){
        return view('customer.author.register');
    }


    public function createUser(Request $request){
        $data = $request->all();

        $validate = $this->authorValidation->validatorCreateUser($data);

        if ($validate->fails()) {
            $errors = $validate->errors();
            throw new ValidationException($validate);
        }
        if($data['password'] == $data['cpassword'] ){
            $user = $this->create($data);
            Auth::login($user);
            return redirect('/')->with('success', 'You have been redirected!');
        }
        else{
            return redirect('/register')->with('error', 'password and Confirm Password not fit');
        }
      
       
    }

    protected function create(array $data)
    {
        $data = [
            'name' =>$data['name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ];
        $user = $this->userService->create($data);
        return $user;
    }
    
    public function loginUser(Request $request)
    {
        $data = $request->all();
        $validate = $this->authorValidation->validateLogin($data);
        if ($validate->fails()) {
            $errors = $validate->errors();
            throw new ValidationException($validate);
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (auth()->user()->role_id == 1) {
                return redirect()->route('dashboard');
            } else  if(auth()->user()->role_id == 0){
                return redirect('/');
               
            }
        }
        return redirect()->back()->withInput($request->only('email', 'password'))->withErrors([
            'password' => 'Địa chị email hoặc mật khẩu không chính xác.',
        ]);
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

}
