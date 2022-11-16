<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'additionalData' => [
                'storeName' => 'Mega Store',
                'storeProductsLink' => 'http://127.0.0.1:8000/products',
            ],
        ];
    }
}
