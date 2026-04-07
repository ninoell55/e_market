<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', ['title' => 'List Categories'], compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create', ['title' => 'Create Category']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name'
        ]);

        Category::create($validated);

        Alert::success('Success', 'Category created successfully!');
        return redirect()->route('admin.category.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', ['title' => 'Edit Category'], compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name'
        ]);

        $category->update($validated);

        Alert::success('Success', 'Category updated successfully!');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            Alert::success('Success', 'Category deleted successfully!');
            return redirect()->route('admin.category.index');
        } catch (QueryException $e) {
            Alert::error('Error', 'Data cannot be deleted because it is being used in another table.');
            return redirect()->route('admin.category.index');
        }
    }
}
