<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('units', 'products.unit_id', '=', 'units.id')
            ->select('products.*', 'categories.category_name', 'units.unit_name')
            ->get();

        return view('admin.products.index', ['products' => $products]);
    }


    public function create()
    {
        // get all categories
        $categories = Category::all();

        // get all units
        $units = Unit::all();

        return view('admin.products.create', ['categories' => $categories, 'units' => $units]);
    }

    public function store(Request $request)
    {
        // validate the request
        $rule = [
            'product_code' => 'required|unique:products,product_code',
            'product_name' => 'required',
            'product_price' => 'required',
            'product_stock' => 'required|numeric',
            'product_minimum_stock' => 'required|numeric',
            'product_status' => 'required',
            'category_id' => 'required',
            'unit_id' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ];

        // validate and redirect back if validation fails
        $this->validate($request, $rule);

        // create new product
        $product = new Product;

        $product->product_code = $request->product_code;
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_stock = $request->product_stock;
        $product->product_minimum_stock = $request->product_minimum_stock;
        $product->product_status = $request->product_status;
        $product->product_description = $request->product_description;
        $product->category_id = $request->category_id;
        $product->unit_id = $request->unit_id;

        if ($request->hasFile('product_image')) {
            $product_image = $request->file('product_image');
            $product_image_name = time() . '_' . $product_image->getClientOriginalName();
            $product_image->move(public_path('uploads/products/' . $product->product_code), $product_image_name);
            $product->product_image = $product_image_name;
        }

        $product->save();

        return redirect('/admin/products')->with('success', 'Product created successfully');
    }


    public function edit($id)
    {
        // get the product
        $product = Product::find($id);

        // get all categories
        $categories = Category::all();

        // get all units
        $units = Unit::all();

        return view('admin.products.edit', ['product' => $product, 'categories' => $categories, 'units' => $units]);
    }

    public function update(Request $request, $id)
    {
        $rule = [
            'product_code' => 'required|unique:products,product_code,' . $id,
            'product_name' => 'required',
            'product_price' => 'required',
            'product_stock' => 'required|numeric',
            'product_minimum_stock' => 'required|numeric',
            'product_status' => 'required',
            'category_id' => 'required',
            'unit_id' => 'required',
            'product_image' => 'image|mimes:jpeg,png,jpg,wepb|max:2048'
        ];

        $this->validate($request, $rule);

        // get the product
        $product = Product::find($id);

        $product->product_code = $request->product_code;
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_stock = $request->product_stock;
        $product->product_minimum_stock = $request->product_minimum_stock;
        $product->product_status = $request->product_status;
        $product->product_description = $request->product_description;
        $product->category_id = $request->category_id;
        $product->unit_id = $request->unit_id;

        if ($request->hasFile('product_image')) {
            // delete the old product image
            if ($product->product_image) {
                unlink(public_path('uploads/products/' . $product->product_code . '/' . $product->product_image));
            }

            $product_image = $request->file('product_image');
            $product_image_name = time() . '_' . $product_image->getClientOriginalName();
            $product_image->move(public_path('uploads/products/' . $product->product_code), $product_image_name);
            $product->product_image = $product_image_name;
        }

        $product->save();
    }

    public function destroy($id)
    {
        // get the product
        $product = Product::find($id);

        if ($product) {
            // delete the product image
            if ($product->product_image) {
                unlink(public_path('uploads/products/' . $product->product_code . '/' . $product->product_image));
            }

            $product->delete();

            return redirect('/admin/products')->with('success', 'Product deleted successfully');
        } else {
            return redirect('/admin/products')->with('error', 'Failed to delete product');
        }
    }
}
