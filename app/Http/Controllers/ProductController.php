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
    public function __construct(ProductService $productService )
    {
        $this->productService = $productService;
      
    }
   
    public function detail($id){
        $product = $this->productService->edit($id);
        return view('customer.home.detailProduct' , ["product" => $product]);
    }
   
 }

