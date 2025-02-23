<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['full_image_path'];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'date:Y-m-d',
            'updated_at' => 'date:Y-m-d',
        ];
    }
    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new SortingScope);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function getFullImagePathAttribute()
    {
        return asset(getImagePathFromDirectory($this->name, 'ProductImages', "default.svg"));
    }
    public static function handleProductImages($productID)
    {
        $deletedImages = json_decode(request()->deleted_images ?? "[]");
        $newProductImages = request()->images ?? [];

        foreach ($newProductImages as $imageFile) {
            Image::create([
                'product_id' => $productID,
                'name' => uploadImageToDirectory($imageFile, 'ProductImages'),
            ]);
        }
        /** remove deleted product images from storage folder**/
        foreach ($deletedImages as $imageName) {
            deleteImageFromDirectory($imageName, 'ProductImages');
            Image::where('product_id', $productID)->where('name', $imageName)->delete();
        }
    }
}
