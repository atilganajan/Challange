<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\CreateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class AdminController
{

    public function categoryList(Request $request)
    {

        if ($request->ajax()) {
            $query = Category::all();


            return DataTables::of($query)->make(true);
        }

        return view("admin.category.list");
    }

    public function categoryCreate()
    {
        return view("admin.category.create");
    }

    public function addCategory(CreateCategoryRequest $request)
    {

        Category::create([
            "name" => $request->name,
        ]);

        return redirect('/admin/categories')->with('success', 'Category created successfully');
    }

    public function editCategory($id)
    {

        $category = Category::find($id);

        return view("admin.category.edit")->with(["category" => $category]);
    }

    public function updateCategory(CreateCategoryRequest $request)
    {
        Category::where("id", $request->category_id)->update(["name" => $request->name]);

        return redirect('/admin/categories')->with('success', 'Category updated successfully');
    }

    public function deleteCategory(Request $request)
    {

        $category = Category::find($request->category_id);

        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }

        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }

    public function productCreate(){

        $categories = Category::all();

        return view("admin.product.create")->with(["categories"=>$categories]);
    }

    public function addProduct(CreateProductRequest $request){
        $imagePath = $request->file('image')->store('public/product_images');

        $imagePath = Storage::url($imagePath);

        Product::create([
            'category_id' => $request->category,
            'filename' => $imagePath,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect("/admin/products")->with('success', 'Product added successfully.');
    }

    public function productList(Request $request)
    {

        if ($request->ajax()) {
            $query = Product::with('category');


            return DataTables::of($query)
                ->addColumn('category_name', function ($product) {
                return $product->category->name;
            })->make(true);
        }
        $categories = Category::all();
        return view("admin.product.list")->with(["categories"=>$categories]);
    }

    public function editProduct($id)
    {

        $product = Product::find($id);
        $categories = Category::all();

        return view("admin.product.edit")->with(["product" => $product,"categories"=>$categories]);
    }

    public function updateProduct(CreateProductRequest $request){
        $product= Product::find($request->product_id);
        $imagePath = $product->filename;
        if($request->file('image') && $request->old_image == 0){
            $imagePath =  $this->formatStorageFilePath($imagePath);
            Storage::disk('public')->delete($imagePath);

            $imagePath = $request->file('image')->store('public/product_images');
            $imagePath = Storage::url($imagePath);
        }

        $product->update([
            'category_id' => $request->category,
            'filename' => $imagePath,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect("/admin/products")->with('success', 'Product updated successfully.');
    }

    public function deleteProduct(Request $request){

        $product = Product::find($request->product_id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
        $path = $this->formatStorageFilePath($product->filename);
        Storage::disk('public')->delete($path);

        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }

    static function formatStorageFilePath($path){
        return  str_replace('/storage/', '', $path);
    }

}
