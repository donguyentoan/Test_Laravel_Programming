<?php
namespace App\Validation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
class AuthorValidation{
    public function validateLogin(array $data)
    {
        $messages = [
            'email.required' => 'Trường email là bắt buộc.',
            'email.exists' => 'Địa chỉ email không chính xác.',
            'password.required' => 'Trường mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải chứa ít nhất 4 ký tự.',

        ];
        $rules = [
            'email' => 'required|exists:users,email',
            'password' => 'required|min:4',
        ];

        return Validator::make($data, $rules, $messages);
    }
    public function validatorCreateUser(array $data)
    {
        $messages = [
            'phone.required' => 'The phone number is required.',
            'phone.numeric' => 'The phone number must be a valid number.',
            'phone.min' => 'The phone number must be at least 10 digits long.',
            'email.unique' => 'Email đã cung cấp đã tồn tại.',
            'email.email' => "Email không hợp lệ",
            'name.unique' => 'Tên người dùng cung cấp đã tồn tại.',
            'name.regex' => 'Tên người dùng chỉ chứa các kí tự cho phép gồm: Chữ in hoa, chữ in thường',
            'name.min' => 'Username phải chứa ít nhất :min ký tự.',
            'name.max' => 'Tên người dùng không được lớn hơn :max ký tự.',
            'password.required' => 'Trường mật khẩu là bắt buộc.',
            'password.password' => 'Mật khẩu của bạn phải dài từ 8 đến 16 ký tự, phải chứa ít nhất 1 ký tự viết hoa, 1 ký tự viết thường, 1 ký tự số và 1 ký tự đặc biệt..',
            'password.min' => 'Mật khẩu phải chứa ít nhất :min ký tự.',
            'validation.password.mixed' => 'Mật khẩu của bạn phải dài từ 8 đến 16 ký tự, phải chứa ít nhất 1 ký tự viết hoa, 1 ký tự viết thường, 1 ký tự số và 1 ký tự đặc biệt.',
            'validation.password.letters' => 'Mật khẩu của bạn phải dài từ 8 đến 16 ký tự, phải chứa ít nhất 1 ký tự viết hoa, 1 ký tự viết thường, 1 ký tự số và 1 ký tự đặc biệt.',
            'validation.password.symbols' => 'Mật khẩu của bạn phải dài từ 8 đến 16 ký tự, phải chứa ít nhất 1 ký tự viết hoa, 1 ký tự viết thường, 1 ký tự số và 1 ký tự đặc biệt.',
            'validation.password.numbers' => 'Mật khẩu của bạn phải dài từ 8 đến 16 ký tự, phải chứa ít nhất 1 ký tự viết hoa, 1 ký tự viết thường, 1 ký tự số và 1 ký tự đặc biệt.',
        ];
        $rules = [
            'email' => 'required|email|max:255|unique:users',
            'name' => 'required|string|min:6|max:15|unique:users|regex:/^[a-zA-Z0-9_.-]*[a-zA-Z][a-zA-Z0-9_.-]*$/',
            'phone' => 'required|numeric|min:10',
            'password' => ['required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
                    'max:16',
                ],
        ];
        return Validator::make($data, $rules, $messages);
    }
}