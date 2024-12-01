<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'stock',
    ];

    // Example of a relationship, such as a product belonging to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Accessor to format the price
    public function getFormattedPriceAttribute()
    {
        return 'RM' . number_format($this->price, 2);
    }

    // Mutator to store the image path after uploading
    public static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            if ($product->image instanceof \Illuminate\Http\UploadedFile) {
                // Store the image in the public disk and save the path
                $product->image = $product->image->store('products', 'public');
            }
        });
    }

    // Getter to retrieve the full URL for the image
    public function getImageUrlAttribute()
    {
        return Storage::url($this->image);
    }
}
