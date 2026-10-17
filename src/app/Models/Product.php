<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable =[
        "name",
        "description",
        "category_id",
        "image",
        "price",
        "stock",
        "status",
    ];
    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
