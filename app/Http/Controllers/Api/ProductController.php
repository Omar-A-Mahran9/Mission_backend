<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductResource;
use App\Http\Resources\Api\ProductListResource;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today();
        DB::enableQueryLog();
        $products = Product::when($request->type === 'today', function ($query) use ($today) {
            return $query->whereDate('start_time', $today)
                ->whereTime('start_time', '>', Carbon::now());
        }, function ($query) use ($today) {
            return $query->whereDate('start_time', '!=', $today);
        })->withCount('tickets')->paginate(8);
        $query = DB::getQueryLog();
        dd($query);
        return $this->successWithPagination("", ProductListResource::collection($products)->response()->getData(true));
    }
    public function show(Product $product)
    {
        return $this->success("Successfully", new ProductResource($product));
    }
}
