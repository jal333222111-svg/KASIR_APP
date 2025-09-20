<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'kategori_id',
        'image',
        'title',
        'description',
        'price',
        'stock',
        'is_active',
    ];
}

