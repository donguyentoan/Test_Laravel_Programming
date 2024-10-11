<?php
namespace App\Repositories;
interface AddToCartRepositoryInterface {
    public function addCart( array $data );

    public function RemoveCart( $id );
}