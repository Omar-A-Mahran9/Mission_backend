<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
