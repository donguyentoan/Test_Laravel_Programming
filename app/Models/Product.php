<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory ;

    protected $fillable = ['name', 'manufacturer', 'model', 'engine_capacity' , 'price' , 'tags' , 'image ', 'is_active' , 'created_at' , 'updated_at'];

    // public function toSearchableArray()
    // {
    //     return [
    //         'name' => $this->name,
    //         'description' => $this->description,
    //         'price' => $this->price,
    //         'manufacturer' => $this->manufacturer,
    //     ];
    // }
}
