<?php

namespace App\Http\Controllers\backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Response;
use Illuminate\Http\RedirectResponse;
use App\Http\Repository\CategoryRepository;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * The category repository instance.
     *
     * @var \App\Repositories\CategoryRepository
     */
    protected $categories;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\CategoryRepository  $categories
     * @return void
     */
    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }
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
        $this->categories->create($request);
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
            $this->categories->update($request, $category);
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
