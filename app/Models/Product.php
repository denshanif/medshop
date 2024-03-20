<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code',
        'product_name',
        'product_image',
        'product_price',
        'product_stock',
        'product_minimum_stock',
        'product_status',
        'product_description',
        'category_id',
        'unit_id',
    ];
}
