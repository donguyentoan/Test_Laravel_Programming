<?php
namespace App\Services;
use App\Repositories\AddToCartRepositoryInterface;


class AddToCartService {
    protected $addtocartRepository;
    public function __construct( AddToCartRepositoryInterface $addtocartRepository ) {
        $this->addtocartRepository = $addtocartRepository;
    }
    public function addCart( array $data ) {
        return $this->addtocartRepository->addCart($data);
    }

    public function RemoveCart($id){

        return $this->addtocartRepository->RemoveCart($id);
    }
    public function  UpdateCart($id , $quantity){
        return $this->addtocartRepository->UpdateCart($id ,$quantity);
    }
}