<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'productname',
        'price',
        'imgupload',
        'brand',
        'category',
        'description'
    ];
    public function getCategory()
    {
        return $this->hasOne(Category::class, 'id', 'category');
    }
    public function getBrand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand');
    }

}
