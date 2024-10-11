<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;

class HomeController extends Controller {
    protected $productService;

    public function __construct( ProductService $productService )
    {
        $this->productService = $productService;
    }
    public function home()
    {
        $product = $this->productService->findByActive();
        return view( 'customer.home.index', [ 'products' => $product ] );
    }
}
