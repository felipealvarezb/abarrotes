<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProductCollection;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductApiController extends Controller
{
    public function index()
    {
        return new ProductCollection(Product::all());
    }

    public function paginate()
    {
        return new ProductCollection(Product::paginate(5));
    }
}
