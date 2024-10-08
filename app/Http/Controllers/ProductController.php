<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('admin.product.index' , ["products" => $products]);
    }
    public function add(){
        return view('admin.product.add');
    }
    public function edit($id){
        $product = Product::find($id);
        return view('admin.product.edit' , ["product" => $product]);
    }

    protected function validateAddProduct(array $data)
    {
        $rules = [
            'name' => 'required|max:255',
            'manufacturer' => 'required|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:3072',
            'model' => 'required|numeric',
            'engine_capacity' => 'required',
            'tags' => 'required',
            'price' => 'required|numeric',
        ];
    
        $messages = [
            'name.required' => 'The product name is required.',
            'name.max' => 'The product name may not be greater than 255 characters.',
            'manufacturer.required' => 'The manufacturer field is required.',
            'manufacturer.max' => 'The manufacturer may not exceed 1000 characters.',
            'image.required' => 'Please upload an image for the product.',
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
    
        return Validator::make($data, $rules, $messages);
    }
    
    public function addProduct(Request $request){

        $data = $request->all();
        $validate = $this->validateAddProduct($data);
        if ($validate->fails()) {
            $errors = $validate->errors();
            throw new ValidationException($validate);
        }
            // Kiểm tra xem sản phẩm có tồn tại hay không
            $existingProduct = Product::where('name', $request->input('name'))->first();


            if ($existingProduct) {
                return redirect('/productList')->with('success', 'Product Already Exists');
            }


          
                $fileName = null;


                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    // Handle file here
                    $file = $request->file('image');
                    $fileName = time(). $file->getClientOriginalName();
                    $path = 'upload';
                    $file->move($path, $fileName);
                }

           
                $status = 0 ;
            
                if($request->input('status')=="on") {
                    $status = 1;
                }
                $product = new Product();
                $product->name = $request->input('name');
                $product->manufacturer = $request->input('manufacturer');
                $product->image = $fileName;
                $product->price = $request->input('price');
                $product->model = $request->input('model');
                $product->engine_capacity = $request->input('engine_capacity');
                $product->tags = $request->input('tags') ? json_encode(explode(',', $request->input('tags'))) : null;
                $product->is_active = $status;
                $product->save();
             


            return redirect('/dashboard/product')->with('success', 'Add successfully');
        }


        public function store(Request $request){
            
            $data = $request->all();
            $validate = $this->validateEditProduct($data);
            if ($validate->fails()) {
                $errors = $validate->errors();
                throw new ValidationException($validate);
            }

            $product = Product::find($data['id']);
                    $status = 0 ;
                    if($request->input('status')=="on") {
                        $status = 1;
                    }
                    
                    if ($request->hasFile('image')) {
                        // Delete the old photo if it exists
                        $oldPhoto = $product->image;
                        if ($oldPhoto != null && file_exists('upload/' . $oldPhoto)) {
                            $deleted = unlink('upload/' . $oldPhoto);
                            // Check if the delete was successful
                            if ($deleted) {
                                // Upload the new image
                                $file = $request->file('image');
                                $fileName = time() . $file->getClientOriginalName();
                                $path = 'upload';
                                $file->move($path, $fileName);
                                $product->image = $fileName;
                            }
                            } else {
                                // If there's no old photo or it doesn't exist, just upload the new image
                                $file = $request->file('image');
                                $fileName = time() . $file->getClientOriginalName();
                                $path = 'upload';
                                $file->move($path, $fileName);
                                $product->image = $fileName;
                            }
                        }
                        $product->name = $request->input('name');
                        $product->manufacturer = $request->input('manufacturer');
                        $product->price = $request->input('price');
                        $product->model = $request->input('model');
                        $product->engine_capacity = $request->input('engine_capacity');
                        $product->tags = $request->input('tags') ? json_encode(explode(',', $request->input('tags'))) : null;
                        $product->is_active = $status;
                        $product->save();
                return redirect('/dashboard/product')->with('success', 'Edit successfully');
            
        }

        protected function validateEditProduct(array $data)
        {
            $rules = [
                'name' => 'required|max:255',
                'manufacturer' => 'required|max:1000',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:3072',
                'model' => 'required|numeric',
                'engine_capacity' => 'required',
                'tags' => 'required',
                'price' => 'required|numeric',
            ];
        
            $messages = [
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
        
            return Validator::make($data, $rules, $messages);
        }


        public function delete($id){

            $product = Product::find($id);

            if ($product) {
                $product->delete();
                $oldPhoto = $product->image;
                if ($oldPhoto != null && file_exists('upload/' . $oldPhoto)) {
                    unlink('upload/' . $oldPhoto);
                }  
                return redirect("/dashboard/product")->with('success', 'Xóa thành công');
            } else {
                // Nếu sản phẩm với ID cụ thể không tồn tại, chuyển hướng với thông báo lỗi.
                return redirect('/dashboard/product')->with('error', 'Lỗi! Không tìm thấy sản phẩm');
            }
        }
    
}
