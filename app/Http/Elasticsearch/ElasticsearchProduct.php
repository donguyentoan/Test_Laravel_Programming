<?php
namespace App\Http\Elasticsearch;

use Exception;
use App\Models\Product;

class ElasticsearchProduct 
{
    public static  $index = 'products';

    public function indexProduct(Product $product)
    {
        
        $client = app('elasticsearch');
        $dataProduct = [
            'name' => $product->name,
            'manufacturer' => $product->manufacturer,
            'image' => $product->image,
            'price' => $product->price,
            'model' => $product->model,
            'engine_capacity' => $product->engine_capacity,
            'tags' => $product->tags,
            'is_active' => true, 
        ];
        $params = [
            'index' => self::$index,
            'type' => '_doc', 
            'id' =>  $product->id,
            'body'  => $dataProduct,
        ];
        try {
            $response = $client->index($params);
            if ($response['result'] === 'created') {
                return response()->json(['message' => 'Product added successfully.', 'id' => $response['_id']], 201);
            } else {
                return response()->json(['message' => 'Failed to add product.'], 500);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }  
        
    }

    public function deleteProduct($id)
    {
       
        $client = app('elasticsearch');
        
        $params = [
            'index' => self::$index,
            'type' => '_doc', 
            'id' => $id,
        ];
    
     
        try {
            $response = $client->delete($params);
            dd($reponse);
            if ($response['result'] === 'deleted') {
                return response()->json(['message' => 'Product deleted successfully.'], 200);
            } else {
                return response()->json(['message' => 'Failed to delete product.'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateProduct(Product $product)
    {
        $client = app('elasticsearch');
        $dataProduct = [
            'name' => $product->name,
            'manufacturer' => $product->manufacturer,
            'image' => $product->image,
            'price' => $product->price,
            'model' => $product->model,
            'engine_capacity' => $product->engine_capacity,
            'tags' => json_encode($product->model),
            'is_active' => true, 
        ];
        $params = [
            'index' =>  self::$index,
            'id'    => $product->id,
            'body'  => $dataProduct,
            'type' => '_doc',
        ];
        try {
            $response = $client->index($params); 
            if ($response['result'] === 'updated') {
                return response()->json(['message' => 'Product updated successfully.'], 200);
            } else {
                return response()->json(['message' => 'Failed to update product.'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


 

}
