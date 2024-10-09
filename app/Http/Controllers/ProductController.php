<?php
namespace App\Http\Controllers;
use App\Models\Product;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use App\Validation\ProductValidation;
use Elastic\Elasticsearch\ClientBuilder;
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
    public function addProduct(ProductRequest $request)
    {
        $data = $request->validated();
    
        // Kiểm tra xem sản phẩm đã tồn tại hay chưa
        $existingProduct = $this->productService->findByName($request->input('name'));
        if ($existingProduct) {
            return redirect('/productList')->with('success', 'Product Already Exists');
        }     
    
        $fileName = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = 'upload';
            $file->move($path, $fileName);
        }  
    
        // Xử lý trạng thái
        $status = $request->input('status') === "on" ? 1 : 0;
    
        // Dữ liệu sản phẩm
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
    
        // Thêm sản phẩm vào database
        $product = $this->productService->addProduct($dataProduct);
    
        // Index sản phẩm vào Elasticsearch
        $reponse = $this->indexProduct($product);
       
      return redirect('/dashboard/product')->with('success', 'Add successfully');
    }

    public function indexProduct(Product $product)
    {
        $client = app('elasticsearch');
        $dataProduct = [
            'name' => $product->name,
            'manufacturer' => $product->manufacturer,
            'image' => $product->image,
            'price' => $product->price,
            'model' => $product->model,
            'engine_capacity' => $product->engine_capacity,
            'tags' => json_encode($product->model),
            'is_active' => true, // sử dụng false cho giá trị boolean
        ];
        $params = [
            'index' => 'my_index',
            'type' => '_doc', 
            'id' =>  $product->id,
            'body'  => $dataProduct,
        ];

        
        try {
            $response = $client->index($params);
            if ($response['result'] === 'created') {
                return response()->json(['message' => 'Product added successfully.', 'id' => $response['_id']], 201);
            } else {
                return response()->json(['message' => 'Failed to add product.'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }  
        
    }
    
     
  

    
    private function indexExists($indexName, $client)
    {
        try {
            return $client->indices()->exists(['index' => $indexName]);
        } catch (\Exception $e) {
            \Log::error('Error checking index existence: ' . $e->getMessage());
            return false;
        }
    }
    
        



    public function store(ProductRequest $request){
          
            $data = $request->validated();
            $data = $request->all();
            // $validate = $this->productValidation->validateEditProduct($data);
            // if ($validate->fails()) {
            //     $errors = $validate->errors();
            //     throw new ValidationException($validate);
            // }
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

        public function delete($id)
        {
            $product = $this->productService->edit($id);
            if (!$product) {
                return redirect('/dashboard/product')->with('error', 'Lỗi! Không tìm thấy sản phẩm');
            }
            $product->delete();
            $oldPhoto = $product->image;
            if ($oldPhoto !== null && file_exists('upload/' . $oldPhoto)) {
                unlink('upload/' . $oldPhoto);
            }
            return redirect("/dashboard/product")->with('success', 'Xóa thành công');
        }
        
    
        public function search(Request $request)
        {
           
            $client = app('elasticsearch');
    
            $params = [
                'index' => 'my_index',
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
                return (object) [
                    'id' => $hit['_id'], // Lấy ID
                    'source' => $hit['_source'] // Các trường khác
                ];
            });
            return view('customer.result.searchResult', compact('products'));
        }

    }
