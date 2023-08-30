<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
   public function index()
   {
      return view('Products_management.Brand', ['brands' => Brand::all()]);
   }
   public function store(Request $request)
   {
      $data = validator::make($request->all(), [
         'name' => 'required',
      ], [
         'name.required' => 'Name is Required'
      ])->validate();
      $created = Brand::create($data);
      $totalnumber = count(Brand::all());
      return response()->json(['brand' => $created, 'totalnumber' => $totalnumber, 'action' => 'Added']);
   }
   public function edit($id)
   {

      $brand = Brand::where('id', $id)->first();
      return response()->json($brand);
   }
   public function update(Request $request, $id)
   {
      $data = validator::make($request->all(), [
         'name' => 'required',
      ], [
         'name.required' => 'Name is Required'
      ])->validate();

     $updatedData = Brand::where('id', $id)->update($data);
     if($updatedData){
      $action="Updated";
     }

      return response()->json(['updatedData' => $data, 'id' => $id, 'action' => $action]);
   }
   public function delete($id)
   {

      Brand::where('id', $id)->delete();
      return response()->json(['id' => $id, 'action' => "Deleted"]);
   }
}
