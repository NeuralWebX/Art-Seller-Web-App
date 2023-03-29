<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get all of the comments for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
    public function getCategoryImageAttribute()
    {
        if (array_key_exists('category_image', $this->attributes)) {
            $categoryImage = $this->attributes['category_image'];
            if ($categoryImage) {
                return asset('uploads/category/' . $categoryImage);
            }
        }
        return null;
    }
}
