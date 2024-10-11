<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest {
    /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */

    public function authorize() {
        return true;
    }

    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */

    public function rules() {
        return [
            'name' => 'required|max:255',
            'manufacturer' => 'required|max:1000',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:3072',
            'model' => 'required|numeric',
            'engine_capacity' => 'required',
            'tags' => 'required',
            'price' => 'required|numeric',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'The product name is required.',
            'name.max' => 'The product name may not be greater than 255 characters.',
            'manufacturer.required' => 'The manufacturer field is required.',
            'manufacturer.max' => 'The manufacturer may not exceed 1000 characters.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, or gif.',
            'image.max' => 'The image may not be greater than 3 MB.',
            'model.required' => 'The model field is required.',
            'model.numeric' => 'The model must be a valid number.',
            'engine_capacity.required' => 'The engine capacity field is required.',
            'tags.required' => 'The tags field is required.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price must be a valid number.',
        ];
    }
}
