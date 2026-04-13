<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', ['title' => 'Categories List'], compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create', ['title' => 'Add New Category']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name'
        ]);

        Category::create($validated);

        Alert::success('Success', 'Category created successfully!');
        return redirect()->route('admin.category.index');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', ['title' => 'Edit Category'], compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name'
        ]);

        $category->update($validated);

        Alert::success('Success', 'Category updated successfully!');
        return redirect()->route('admin.category.index');
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            Alert::success('Success', 'Category deleted successfully!');
            return redirect()->route('admin.category.index');
        } catch (QueryException $e) {
            Alert::error('Error', 'Data cannot be deleted because it is being used in another products.');
            return redirect()->route('admin.category.index');
        }
    }
}
