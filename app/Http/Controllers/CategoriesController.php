<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    public function index()
    {

        return view('Products_management.Categories', ['categories' => Category::all()]);
    }
    public function store(Request $request)
    {
        $data = validator::make($request->all(), [
            'category' => 'required'
        ], [
            'category.required' => "category is Required",
        ])->validate();

        $createddata =  Category::create($data);
        $nummberOfdata = count(Category::all());
        return response()->json([$createddata, 'index' => $nummberOfdata, 'action' => "Added"]);
    }
    public function edit($id)
    {

        $category = Category::where('id', $id)->first();
        return response()->json(['action' => "update", $category]);
    }
    public function update(Request $request, $id)
    {

        $data = validator::make($request->all(), [
            'category' => 'required'
        ], [
            'category.required' => "category is Required",
        ])->validate();
        Category::where('id', $id)->update($data);

        return response()->json([$data, 'id' => $id, 'action' => "Updated"]);
    }

    public function delete($id)
    {
        Category::where('id', $id)->delete();
        return response()->json(['id' => $id, 'action' => 'Deleted']);
    }
}
