<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Bid;
use App\Models\Image;
use App\Models\Refund;
use App\Models\Winner;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\ProductBidding;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreProductRequest;
use App\Http\Requests\Dashboard\UpdateProductRequest;
use App\Models\Ticket;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_products');

        if ($request->ajax()) {
            $data = getModelData(model: new Product(), relations: ['images' => ['id', 'product_id', 'name']]);
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
        $productData = Arr::except($data, ['variations', 'images']);
        $productData['admin_id'] = auth()->id();
        $product = Product::create($productData);
        foreach ($data['variations'] as $bidding) {
            $product->productBiddings()->create($bidding);
        }
        Image::handleProductImages($product->id);

        return response(["Product created successfully"]);
    }
    public function edit(Product $product)
    {
        $this->authorize('update_products');
        abort_if($product->tickets()->exists(), 404, __("This product cannot be updated because it has associated tickets"));
        $product->load('productBiddings');
        return view('dashboard.products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->authorize('update_products');
        abort_if($product->tickets()->exists(), 404, __("This product cannot be updated because it has associated tickets"));
        $data          = $request->validated();
        $productData = Arr::except($data, ['variations', 'images', 'deletedVariations', 'deleted_images']);
        $product->update($productData);
        foreach ($data['variations'] as $bidding) {
            $product->productBiddings()->updateOrCreate(
                ['id' => $bidding['id'] ?? null], // Check if the ID exists
                $bidding // Update existing or create new
            );
        }
        // Handle deleted variations
        if ($request->deletedVariations) {
            ProductBidding::whereIn('id', $request->deletedVariations)->delete(); // Bulk delete
        }
        Image::handleProductImages($product->id);
        return response(["Product update successfully"]);
    }
    public function show(Request $request, Product $product)
    {
        $this->authorize('show_products');
        $params = request()->all();

        $product->load([
            'images',
            'productBiddings',
            'winners.user',
            'winners.address.city',
            'winners.bid',
            'refunds.user',
        ])->loadCount(['bids', 'refunds', 'tickets' => fn($query) => $query->whereDoesntHave('refunds'),]);
        if ($request->ajax()) {
            $type = $params['type'] ?? 'tickets'; // Default to tickets

            if ($type === 'refunds') {
                $model = Refund::with('user')->where('product_id', $product->id);
            } elseif ($type === 'bids') {
                $model = Bid::with('user')->where('product_id', $product->id);
            } elseif ($type === 'tickets') {
                $model = Ticket::with('user')->where('product_id', $product->id)->whereDoesntHave('refunds');
            }
            $response = [
                "recordsTotal" => $model->count(),
                "recordsFiltered" => $model->count(),
                'data' => $model->skip($params['start'])->take($params['length'])->get()
            ];

            return response($response);
        }
        if ($request->ajax()) {
            $model = Bid::with('user')->where('product_id', $product->id);

            $response = [
                "recordsTotal" => $model->count(),
                "recordsFiltered" => $model->count(),
                'data' => $model->skip($params['start'])->take($params['length'])->get()
            ];

            return response($response);
        }
        return view('dashboard.products.show', compact('product'));
    }
    public function destroy(Product $product)
    {
        $this->authorize('delete_products');
        abort_if($product->tickets()->exists(), 404, __("This product cannot be deleted because it has associated tickets"));
        $product->delete();

        return response(["Product deleted successfully"]);
    }

    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_products');
        $productsWithTickets = Product::whereIn('id', $request->selected_items_ids)
            ->whereHas('tickets')
            ->exists();
        abort_if($productsWithTickets, 404, __("Some products cannot be deleted because they have associated tickets"));
        Product::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected product deleted successfully"]);
    }

    public function images(Product $product)
    {
        $productImages = $product->images->toArray();
        $images        = scandir(public_path('/storage/Images/ProductImages'));

        foreach ($productImages as $imageName) {
            $imageName = $imageName['name'];

            if (in_array($imageName, $images)) {
                $image['name'] = $imageName;
                $filePath      = public_path("/storage/Images/ProductImages/$imageName");
                $image['size'] = filesize($filePath);
                $image['path'] = asset("/storage/Images/ProductImages/$imageName");
                $data[]        = $image;
            }
        }

        return response()->json($data);
    }
    public function updateDelivery(Request $request, Winner $Winner)
    {
        $Winner->update(['is_deliverd' => true, 'deliverd_at' => now()]); // Update status

        return back()->with('success', 'Delivery status updated successfully!');
    }
}
