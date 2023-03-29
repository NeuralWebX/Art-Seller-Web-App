<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Client\Response;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('backend.pages.category.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();
        return view('backend.pages.category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
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
        alert()->success('Category Created Successfully');
        return to_route('backend.category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('backend.pages.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('backend.pages.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request,  $id)
    {
        $category = Category::find($id);
        try {
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
            alert()->success('Category Updated Successfully');
            return to_route('backend.category.index');
        } catch (\Throwable $th) {
            alert()->error($th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        try {
            $category->delete();
            alert()->warning('Category Deleted Successfully');
            return to_route('backend.category.index');
        } catch (\Throwable $th) {
            alert()->error($th->getMessage());
            return to_route('backend.category.index');
        }
    }
}
