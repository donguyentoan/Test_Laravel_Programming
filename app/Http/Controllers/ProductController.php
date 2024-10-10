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
use App\Http\Elasticsearch\ElasticsearchProduct;

class ProductController extends Controller
{
   
    protected $productService;
    protected $productValidation;
    protected $elasticsearchProduct;
    public function __construct(ProductService $productService , ProductValidation $productValidation , ElasticsearchProduct $elasticsearchProduct)
    {
        $this->elasticsearchProduct = $elasticsearchProduct;
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
        $status = $request->input('status') === "on" ? 1 : 0;

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
    
        
   
        $reponse = $this->indexProduct($product);
       
      return redirect('/dashboard/product')->with('success', 'Add successfully');
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
                    $oldPhoto = $product->image;
                    $fileName = " ";
                    if ($request->hasFile('image')) {
                        // Delete the old photo if it exists
                        
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
                            'image' => ($fileName != " ") ? $fileName :  $oldPhoto,
                            'price' => $request->input('price'),
                            'model' => $request->input('model'),
                            'engine_capacity' => $request->input('engine_capacity'),
                            'tags' => $request->input('tags') ? json_encode(explode(',', $request->input('tags'))) : null,
                            'is_active' => $status,
                        ];
                        $product = $this->productService->store($product->id , $data);
                    
                       $reponse =  $this->updateProduct($product);
                       $statusCode = $reponse->getStatusCode();
                       if($statusCode == 200){
                            return redirect('/dashboard/product')->with('success', 'Edit successfully'); 
                       } 
        }

        public function delete($id)
        {
            $product = $this->productService->edit($id);
            if (!$product) {
                return redirect('/dashboard/product')->with('error', 'Lỗi! Không tìm thấy sản phẩm');
            }
            $product->delete();
            $this->deleteProduct($id);
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
                            'fields' => ['model', 'name'],
                        ],
                    ],
                ],
            ];
            $response = $client->search($params);
            $products = collect($response['hits']['hits'])->map(function ($hit) {
                return (object) [
                    'id' => $hit['_id'],
                    'source' => $hit['_source'] 
                ];
            });
            return view('customer.result.searchResult', compact('products'));
        }

    }


