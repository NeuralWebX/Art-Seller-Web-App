<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use App\Models\ProductView;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get the user that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    /**
     * Get the user that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    /**
     * Get the user associated with the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function productView(): HasOne
    {
        return $this->hasOne(ProductView::class, 'product_id', 'id');
    }
    public function getProductImageAttribute()
    {
        if (array_key_exists('product_image', $this->attributes)) {
            $productImage = $this->attributes['product_image'];
            if ($productImage) {
                return asset('uploads/product/' . $productImage);
            }
        }
        return null;
    }
}