<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use App\Validation\ProductValidation;
use App\Http\Elasticsearch\ElasticsearchProduct;

class AdminController extends Controller
{
   public function index(){
    return view('admin.dashboard.index');
   }

   protected $productService;
   protected $productValidation;
   protected $elasticsearchProduct;
   public function __construct(ProductService $productService , ProductValidation $productValidation , ElasticsearchProduct $elasticsearchProduct)
   {
       $this->elasticsearchProduct = $elasticsearchProduct;
       $this->productService = $productService;
       $this->productValidation = $productValidation;
   }
   public function indexProduct(){
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
           'image' => ($fileName) ? $fileName : " " ,
           'price' => $request->input('price'),
           'model' => $request->input('model'),
           'engine_capacity' => $request->input('engine_capacity'),
           'tags' => $request->input('tags') ? json_encode(explode(',', $request->input('tags'))) : null,
           'is_active' => $status,
       ];   
       $product = $this->productService->addProduct($dataProduct);
    
       // $this->elasticsearchProduct->addProduct($dataProduct);   
       $reponse = $this->elasticsearchProduct->indexProduct($product);
       $statusCode = $reponse->getStatusCode();
       if($statusCode == 201 && $product != null ){
           return redirect('/dashboard/product')->with('success', 'Add successfully');
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
                      $reponse = $this->elasticsearchProduct->updateProduct($product);
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
           $oldPhoto = $product->image;
           if ($oldPhoto !== null && file_exists('upload/' . $oldPhoto)) {
               unlink('upload/' . $oldPhoto);
           }
           $reponse = $this->elasticsearchProduct->deleteProduct($id);
           $statusCode = $reponse->getStatusCode();
           if($statusCode == 500){
                return redirect('/dashboard/product')->with('success', 'Delete successfully'); 
           } 
       }
   
}
