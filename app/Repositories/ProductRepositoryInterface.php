<?php
namespace App\Repositories;
interface ProductRepositoryInterface
{
    public function index();
    public function edit($id);
    public function addProduct(array $data);
    public function store($id, array $data);
    public function delete($id);
    public function findByName($name);
    public function findByActive();
}