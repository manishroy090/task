<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $categoryList = Category::all();
        $branList = Brand::all();
        $productlist = Product::all();
        return view('Products_management.add_product', compact('categoryList', 'branList', 'productlist'));
    }
    public function store(Request $request)
    {

        $data = validator::make($request->all(), [
            'productname' => 'required',
            'price' => 'required|numeric|gt:0',
            'imgupload' => 'required',
            'brand' => 'required',
            'category' => 'required',
            'description' => 'required',
        ], [
            'productname.required' => 'Product Name is Required',
            'price.required' => 'Price is Required',
            'price.numeric' => 'Price Must be Number',
            'price.gt' => 'Price Should greate than Zero',
            'imgupload.required' => 'img is Required',
            'brand.required' => "brand is Required",
            'category.required' => 'Category is Required',
            'description.required' => 'Description is Required'

        ])->validate();
        $filename = time() . "product." . $request->file('imgupload')->extension();;
        $request->file('imgupload')->storeAs('uploads', $filename, 'public');
        $data['imgupload'] = $filename;
        $index = count(Product::all());
        $createdData = Product::create($data);
        $createdData['imgupload'] = asset('/storage/uploads/' . $createdData['imgupload']);
        return response()->json([$createdData, 'index' => $index, 'action' => 'Added']);
    }
    public function edit($id)
    {
        //    dd(asset('/storage/uploads/'));
        $product = Product::where('products.id', $id)->first();
        $product['imgupload'] = asset('/storage/uploads/' . $product->imgupload);
        return response()->json(['product' => $product, 'msg' => "Product updated Successfully"]);
    }
    public function update(Request $request, $id)
    {
        $data = validator::make($request->all(), [
            'productname' => 'required',
            'price' => 'required |numeric|gt:0',
            'imgupload' => 'nullable',
            'brand' => 'required',
            'category' => 'required',
            'description' => 'required',
        ], [
            'productname.required' => 'Product Name is Required',
            'price.required' => 'Price is Required',
            'price.numeric' => 'Price Must be Number',
            'price.gt' => 'Price Should Greater than Zero',
            'imgupload.required' => 'imgupload is nullable',
            'brand.required' => "brand is Required",
            'category.required' => 'Category is Required',
            'description.required' => 'Description is Required'

        ])->validate();
        if ($request->file('imgupload') != null) {
            $filename = time() . "product." . $request->file('imgupload')->extension();;
            $request->file('imgupload')->storeAs('uploads', $filename, 'public');
            $data['imgupload'] = $filename;
            $data['imgupload'] = asset('/storage/uploads/' . $data['imgupload']);
        }

        $updateddata = Product::where('id', $id)->update($data);
        $brand = Brand::where('id', $data['brand'])->value('name');
        $category = Category::where('id', $data['category'])->value('category');
        $data['brand'] = $brand;
        $data['category'] = $category;
        return response()->json([$data, 'action' => "Updated", 'id' => $id]);
    }

    public function delete($id)
    {
        Product::where('id', $id)->delete();
        return response()->json(['id' => $id, 'action' => "Deleted"]);
    }
    public function brandList(Request $request)
    {
        $results = [];
        if ($request->get('type') == "brand") {
            $results = Brand::query()
                ->where(function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->input('term', '') . '%');
                })
                ->get(['id as id', 'name as text']);
        }
        return  ['results' => $results];
    }
    public function products()
    {
        $productlist = Product::all();
        return view('Products_management.Products', compact('productlist'));
    }
}
