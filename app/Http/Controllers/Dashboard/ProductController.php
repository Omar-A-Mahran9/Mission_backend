<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_products');

        if ($request->ajax()) {
            $data = getModelData(model: new Product());

            return response()->json($data);
        }

        return view('dashboard.products.index');
    }

    public function create()
    {
        $this->authorize('create_products');

        return view('dashboard.products.create');
    }
    public function store(StoreProductRequest $request)
    {
        $this->authorize('create_products');

        $data          = $request->validated();
dd($data);
        $product = Product::create($data);
        // $product->
        Image::handleProductImages($product->id);

        return response(["Product created successfully"]);
    }
}
