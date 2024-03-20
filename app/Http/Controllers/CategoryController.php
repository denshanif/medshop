<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        // Get all categories
        $categories = Category::all();

        return view('admin.categories.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {

        $category = new Category;

        $category->category_name = $request->category_name;
        $category->slug = $request->slug;

        $category->save();

        if ($category->save()) {
            return redirect('admin/categories')->with('success', 'Category created successfully');
        } else {
            return redirect('admin/categories')->with('error', 'Failed to create category');
        }
    }

    public function edit($id)
    {
        // Get the category
        $category = Category::find($id);

        return view('admin.categories.edit', ['category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $category->category_name = $request->category_name;
        $category->slug = $request->slug;

        $category->save();

        if ($category->save()) {
            return redirect('admin/categories')->with('success', 'Category updated successfully');
        } else {
            return redirect('admin/categories')->with('error', 'Failed to update category');
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if ($category) {
            $category->delete();
            return redirect('admin/categories')->with('success', 'Category deleted successfully');
        } else {
            return redirect('admin/categories')->with('error', 'Failed to delete category');
        }
    }
}
