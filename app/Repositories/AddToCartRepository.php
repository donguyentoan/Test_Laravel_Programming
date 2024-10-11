<?php
namespace App\Repositories;

use App\Models\Product;
use App\Models\AddToCart;
use App\Repositories\AddToCartRepositoryInterface;

class AddToCartRepository implements  AddToCartRepositoryInterface {
    protected $model;

    public function __construct( AddToCart $addtocart )
    {
        $this->model = $addtocart;
    }

    public function addCart( array $data )
    {
        $cart = new AddToCart();
        $cart->id_product = $data[ 'id_product' ];
        $cart->name = $data[ 'name' ];
        $cart->image = $data[ 'image' ];
        $cart->price = $data[ 'price' ];
        $cart->quantity = $data[ 'quantity' ];
        $cart->save();
        return $cart;
    }

    public function RemoveCart( $id )
    {
        $cart = AddToCart::where( 'id_product', $id )->first();
        $cart->delete();
    }

    public function UpdateCart( $id, $quantity )
    {
        $cart = AddToCart::where( 'id_product', $id )->first();
        $cart->update( [
            'quantity' => $quantity,
        ] );
        return $cart;
    }

}