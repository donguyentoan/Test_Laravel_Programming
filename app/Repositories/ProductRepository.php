<?php
namespace App\Repositories;


use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function index(){

     
        return $this->model->all();
    }
    public function edit($id){
        return $this->model->find($id);
    }
    public function addProduct(array $data){
        $product = new Product();
        $product->name = $data['name'] ?? null;
        $product->manufacturer = $data['manufacturer'] ?? null;
        $product->image = $data['image'];
        $product->price = $data['price'] ?? null;
        $product->model = $data['model'] ?? null;
        $product->engine_capacity = $data['engine_capacity'] ?? null;
        $product->tags = isset($data['tags']) ? json_encode(explode(',', $data['tags'])) : null;
        $product->is_active = $data['is_active'];
        $product->save();
    }
    public function store($id, array $data){
        return $this->model->where('id', $id)->update($data);
    }
    public function delete($id){
        return $this->model->destroy($id);

    }
    public function findByName($name){
        return $this->model->where('name', $name)->first();
    }
    public function findByActive(){
        return $this->model->where('is_active', 1)->get();
    }
    

}