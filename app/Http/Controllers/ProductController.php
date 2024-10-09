<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Validation\ProductValidation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{

    protected $productService;
    protected $productValidation;

    public function __construct(ProductService $productService , ProductValidation $productValidation)
    {
        $this->productService = $productService;
        $this->productValidation = $productValidation;
    }
    public function index(){
        $products = $this->productService->index();
        return view('admin.product.index' , ["products" => $products]);
    }

    public function add(){
        return view('admin.product.add');
    }
    public function edit($id){
        $product = $this->productService->edit($id);
        return view('admin.product.edit' , ["product" => $product]);
    }
   
    
    public function addProduct(Request $request){
        $data = $request->all();
        $validate = $this->productValidation->validateAddProduct($data);
        if ($validate->fails()) {
            $errors = $validate->errors();
            throw new ValidationException($validate);
        }
            $existingProduct = $this->productService->findByName($request->input('name'));
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
               
                $dataProduct = [
                    'name' => $request->input('name'),
                    'manufacturer' => $request->input('manufacturer'),
                    'image' => $fileName,
                    'price' => $request->input('price'),
                    'model' => $request->input('model'),
                    'engine_capacity' => $request->input('engine_capacity'),
                    'tags' => $request->input('tags') ? json_encode(explode(',', $request->input('tags'))) : null,
                    'is_active' => $status,
                ];

                
                $product = $this->productService->addProduct($dataProduct);
                // $this->indexProduct($product);
                // $product = new Product();
                // $product->name = ;
                // $product->manufacturer = 
                // $product->image = $fileName;
                // $product->price = 
                // $product->model = $request->input('model');
                // $product->engine_capacity = $request->input('engine_capacity');
                // $product->tags = $request->input('tags') ? json_encode(explode(',', $request->input('tags'))) : null;
                // $product->is_active = $status;
                // $this->indexProduct($product);
                // $product->save();

            return redirect('/dashboard/product')->with('success', 'Add successfully');
        }
        
    private function indexProduct($product)
        {
            $client = app('elasticsearch');
            $params = [
                'index' => 'products',
                'id'    => $product->id,
                'body'  => [
                    'name' => $product->name,
                    'manufacturer' => $product->manufacturer,
                    'price' => $product->price,
                    'image' => $product->image,
                    'model' => $product->model,
                    'engine_capacity' => $product->engine_capacity,
                    'tags' => $product->tags,
                    'is_active' => $product->is_active
                ],
            ];
    
            $client->index($params);
        }



    public function store(Request $request){
            $data = $request->all();
            $validate = $this->productValidation->validateEditProduct($data);
            if ($validate->fails()) {
                $errors = $validate->errors();
                throw new ValidationException($validate);
            }
            $product = $this->productService->edit($data['id']);
                    $status = 0 ;
                    if($request->input('status')=="on") {
                        $status = 1;
                    }
                    
                    $fileName = " ";
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

                        $data = [
                            'name' => $request->input('name'),
                            'manufacturer' => $request->input('manufacturer'),
                            'image' => $fileName,
                            'price' => $request->input('price'),
                            'model' => $request->input('model'),
                            'engine_capacity' => $request->input('engine_capacity'),
                            'tags' => $request->input('tags') ? json_encode(explode(',', $request->input('tags'))) : null,
                            'is_active' => $status,
                        ];
        

                        
                        $product = $this->productService->store($product->id , $data);

                        // $product->name = $request->input('name');
                        // $product->manufacturer = $request->input('manufacturer');
                        // $product->price = $request->input('price');
                        // $product->model = $request->input('model');
                        // $product->engine_capacity = $request->input('engine_capacity');
                        // $product->tags = $request->input('tags') ? json_encode(explode(',', $request->input('tags'))) : null;
                        // $product->is_active = $status;
                        // $product->save();

                return redirect('/dashboard/product')->with('success', 'Edit successfully');
            
        }

    public function delete($id){
            $product = $this->productService->edit($id);
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
    public function search(Request $request)
    {
        $client = app('elasticsearch');

        $params = [
            'index' => 'products',
            'body'  => [
                'query' => [
                    'multi_match' => [
                        'query' => $request->input('query'),
                        'fields' => ['name', 'description'],
                    ],
                ],
            ],
        ];

        $response = $client->search($params);
        $products = collect($response['hits']['hits'])->map(function ($hit) {
            return (object) $hit['_source'];
        });

        return view('products.index', compact('products'));
    }


    
    }
