<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Product;

class ProductController extends Controller
{
    public function testTags(){

        $tag1 = Tag::firstOrCreate(['name'=>'Discount']);
        $tag2 = Tag::firstOrCreate(['name'=>'Sale']);
        $product=Product::first();
        $product->tags()->attach([$tag1, $tag2]);
        return $product->tags;
    }
}
