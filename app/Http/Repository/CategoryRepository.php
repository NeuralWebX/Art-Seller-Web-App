<?php

namespace App\Http\Repository;

use App\Models\Category;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryRepository
{
    /**
     * Create a new category.
     *
     * @param  array  $data
     * @return \App\Models\Category
     */
    public function create(StoreCategoryRequest $request)
    {
        $category_number = 'category-' . getNumber();
        $categoryExists = Category::where('category_number', $category_number)->exists();
        if ($categoryExists) {
            $category_number = 'category-' . getNumber();
        }
        $image_name = null;
        if ($request->hasFile('category_image')) {
            $image_name = date('Ymdhsis') . '.' . $request->file('category_image')->getClientOriginalExtension();
            $request->file('category_image')->storeAs('/uploads/category', $image_name);
        }
        Category::create([
            'category_name' => $request->category_name,
            'category_details' => $request->category_details,
            'category_number' => $category_number,
            'category_image' => $image_name,
            'category_status' => $request->category_status,
        ]);
    }

    /**
     * Update a category.
     *
     * @param  \App\Models\Category  $category
     * @param  array  $data
     * @return \App\Models\Category
     */
    public function update(UpdateCategoryRequest $request, $category)
    {
        $image_name = $category->category_image;
        if ($request->hasFile('category_image')) {
            $image_name = date('Ymdhsis') . '.' . $request->file('category_image')->getClientOriginalExtension();
            $request->file('category_image')->storeAs('/uploads/category', $image_name);
        }
        $category->update([
            'category_name' => $request->category_name,
            'category_details' => $request->category_details,
            'category_image' => $image_name,
            'category_status' => $request->category_status,
        ]);
    }
}
