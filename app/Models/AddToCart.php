<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddToCart extends Model {
    use HasFactory;
    protected $fillable = [
        'id_product',
        'name',
        'image',
        'price',
        'quantity',
        'created_at',
        'updated_at'
    ];
}
