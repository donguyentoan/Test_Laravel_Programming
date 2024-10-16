<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use App\Http\Elasticsearch\ElasticsearchProduct;

class AdminController extends Controller {
    protected $productService;
 
    protected $elasticsearchProduct;

    public function __construct(
        ProductService $productService,
        ElasticsearchProduct $elasticsearchProduct
    ) {
        $this->elasticsearchProduct = $elasticsearchProduct;
        $this->productService = $productService;
    }

    public function index()
    {
        return view( 'admin.dashboard.index' );
    }
    public function indexProduct()
    {
        $products = $this->productService->index();
        return view( 'admin.product.index', [
            'products' => $products
        ] );
    }
    public function add()
    {
        return view( 'admin.product.add' );
    }
    public function edit($id)
    {
        $product = $this->productService->edit( $id );
        return view( 'admin.product.edit', [
            'product' => $product
        ] );
    }
    public function addProduct(Request $request)
    {
        if($request->file('image') == null){
            return redirect('/productList')->with('error', 'The product image is required.');
        }
        $existingProduct = $this->productService->findByName( $request->input( 'name' ) );
        if ( $existingProduct ) {
         
            
            return redirect( '/productList' )->with( 'success', 'Product Already Exists' );
        }
        $fileName = null;
        if ( $request->hasFile( 'image' ) && $request->file( 'image' )->isValid() ) {
            $file = $request->file( 'image' );
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = 'upload';
            $file->move( $path, $fileName );
        }
        $status = $request->input( 'status' ) === 'on' ? 1 : 0;
        $dataProduct = [
            'name' => $request->input( 'name' ),
            'manufacturer' => $request->input( 'manufacturer' ),
            'image' => ( $fileName ) ? $fileName : ' ',
            'price' => $request->input( 'price' ),
            'model' => $request->input( 'model' ),
            'engine_capacity' => $request->input( 'engine_capacity' ),
            'tags' => $request->input( 'tags' ) ? json_encode( explode( ',', $request->input( 'tags' ) ) ) : null,
            'is_active' => $status,
        ];
        $product = $this->productService->addProduct( $dataProduct );
        $response = $this->elasticsearchProduct->indexProduct( $product );
        $statusCode = $response->getStatusCode();
        if ( $statusCode == 201 && $product != null ) {
            return redirect( '/dashboard/product' )->with( 'success', 'Add successfully' );
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $product = $this->productService->edit( $data[ 'id' ] );
        $status = $request->input( 'status' ) === 'on' ? 1 : 0;
        $oldPhoto = $product->image;
        $fileName = ' ';
        if ( $request->hasFile( 'image' ) ) {
            if ( $oldPhoto != null && file_exists( 'upload/' . $oldPhoto ) ) {
                $deleted = unlink( 'upload/' . $oldPhoto );
                if ( $deleted ) {
                    $file = $request->file( 'image' );
                    $fileName = time() . $file->getClientOriginalName();
                    $path = 'upload';
                    $file->move( $path, $fileName );
                    $product->image = $fileName;
                }
            } else {
                $file = $request->file( 'image' );
                $fileName = time() . $file->getClientOriginalName();
                $path = 'upload';
                $file->move( $path, $fileName );
                $product->image = $fileName;
            }
        }
        $data = [
            'name' => $request->input( 'name' ),
            'manufacturer' => $request->input( 'manufacturer' ),
            'image' => ( $fileName != ' ' ) ? $fileName : $oldPhoto,
            'price' => $request->input( 'price' ),
            'model' => $request->input( 'model' ),
            'engine_capacity' => $request->input( 'engine_capacity' ),
            'tags' => $request->input( 'tags' ) ? json_encode( explode( ',', $request->input( 'tags' ) ) ) : null,
            'is_active' => $status,
        ];
        $product = $this->productService->store( $product->id, $data );
        $response = $this->elasticsearchProduct->updateProduct( $product );
        $statusCode = $response->getStatusCode();
        if ( $statusCode == 200 ) {
            return redirect( '/dashboard/product' )->with( 'success', 'Edit successfully' );
        }
    }

    public function delete($id)
    {
        $product = $this->productService->edit( $id );
        if ( !$product ) {
            return redirect( '/dashboard/product' )->with( 'error', 'Lỗi! Không tìm thấy sản phẩm' );
        }
        $product->delete();
        $oldPhoto = $product->image;
        if ( $oldPhoto !== null && file_exists( 'upload/' . $oldPhoto ) ) {
            unlink( 'upload/' . $oldPhoto );
        }
        $response = $this->elasticsearchProduct->deleteProduct( $id );
        $statusCode = $response->getStatusCode();
        if ( $statusCode == 500 ) {
            return redirect( '/dashboard/product' )->with( 'success', 'Delete successfully' );
        }
    }
}
