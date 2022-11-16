<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ProductHistory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\ImageStorage;

class AdminProductController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Products - Online Store";
        $viewData["products"] = Product::all();
        return view('admin.product.index')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        
        Product::validate($request);

        $newProduct = new Product();
        $newProduct->setName($request->input('name'));
        $newProduct->setBrand($request->input('brand'));
        $newProduct->setCategory($request->input('category'));
        $newProduct->setWeight($request->input('weight'));
        $newProduct->setPrice($request->input('price'));
        $newProduct->setImage("food.png");
        $newProduct->save();
        $imageName = $newProduct->getId().".".$request->file('image')->extension();
        $storage = $request->get('storage');
        $storeInterface = app(ImageStorage::class, ['storage' => $storage]); 
        $storeInterface->store($request, $imageName);
        $newProduct->setImage($imageName);
        $newProduct->save();

        

        return back();
    }

    public function delete($id)
    {
        Product::destroy($id);
        return back();
    }

    public function edit($id)
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Edit Product - Online Store";
        $viewData["product"] = Product::findOrFail($id);
        return view('admin.product.edit')->with("viewData", $viewData);
    }

    public function update(Request $request, $id)
    {

        Product::validate($request);

        $product = Product::findOrFail($id);
        $product->setName($request->input('name'));
        $product->setBrand($request->input('brand'));
        $product->setCategory($request->input('category'));
        $product->setWeight($request->input('weight'));
        if ($product->getPrice() != $request->input('price')) 
        {
            $productHistory = new ProductHistory();
            $productHistory->setIdProduct($id);
            $productHistory->setPrice($request->input('price'));

            $productHistory->save();
        }

        $product->setPrice($request->input('price'));

        $imageName = $product->getId().".".$request->file('image')->extension();
        $storage = $request->get('storage');
        $storeInterface = app(ImageStorage::class, ['storage' => $storage]);  
        $storeInterface->store($request, $imageName);
        $product->setImage($imageName);
        $product->save();
        
        return redirect()->route('admin.product.index');
    }
}
