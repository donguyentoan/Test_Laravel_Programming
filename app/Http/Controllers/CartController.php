<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AddToCartService;

class CartController extends Controller {
    protected $addtocartService;

    public function __construct(AddToCartService $addtocartService)
    {
        $this->addtocartService = $addtocartService;
    }

    public function cart()
    {
        return view( 'customer.cart.Cart' );
    }

    public function saveCart(Request $request)
    {
        $data = [
            'id_product' =>  $request->input( 'product_id' ),
            'name' => $request->input( 'name' ),
            'image' => $request->input( 'image' ),
            'price' => $request->input( 'price' ),
            'quantity' => $request->input( 'quantity' ),
        ];
        return response()->json( [
            'code' => 201,
            'data' => $this->addtocartService->addCart( $data ),
        ], 200 );
    }

    public function removeCart(Request $request)
    {
        $this->addtocartService->RemoveCart( $request->input( 'cart_id' ) );
        return response()->json( [
            'code' => 201,
        ], 200 );
    }

    public function updateCart(Request $request)
    {
        return response()->json( [
            'code' => 201,
            'data' => $this->addtocartService->UpdateCart( $request->input( 'product_id' ), $request->input( 'quantity' ) ),
        ], 200 );

    }

}
