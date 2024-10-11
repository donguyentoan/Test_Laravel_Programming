<?php
namespace App\Services;
use App\Repositories\ProductRepositoryInterface;

class ProductService {
    protected $productRepository;

    public function __construct( ProductRepositoryInterface $productRepository ) {
        $this->productRepository = $productRepository;
    }

    public function index() {
        return $this->productRepository->index();
    }

    public function edit( $id ) {
        return $this->productRepository->edit( $id );
    }

    public function addProduct( array $data ) {
        return $this->productRepository->addProduct( $data );
    }

    public function store( $id, array $data ) {
        return $this->productRepository->store( $id, $data );
    }

    public function delete( $id ) {
        return $this->productRepository->delete( $id );
    }

    public function findByName( $name ) {
        return $this->productRepository->findByName( $name );
    }

    public function findByActive() {
        return $this->productRepository->findByActive();
    }
}
