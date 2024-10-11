<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\LoginRequest;
use App\Validation\AuthorValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AuthorController extends Controller {
    protected $userService;
    protected $authorValidation;

    public function __construct( UserService $userService, AuthorValidation $authorValidation )
    {
        $this->userService = $userService;
        $this->authorValidation = $authorValidation;
    }
}
