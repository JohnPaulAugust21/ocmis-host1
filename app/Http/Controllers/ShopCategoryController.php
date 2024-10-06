<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ShopCategoryController extends Controller
{
    public function index()
    {
        return View('shop.category.index');
    }

    public function allShopCategories()
    {
        $shopcategory = ShopCategory::orderby('category_id', 'ASC')->get();;
        return response()->json($shopcategory);
    }

    public function create()
    {
        return View('shop.category.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['error' => $validator->errors()]);
        }

        try {
            $shopcategory = new ShopCategory();
            $shopcategory->name = $request->name;
            $shopcategory->status = $request->status;

            $file = $request->file('image');
            $imageName = time() . '-' . $file->getClientOriginalName();
            $shopcategory->image = $imageName;
            Storage::put($imageName, file_get_contents($file));

            $shopcategory->save();

            return redirect()->route('shopCategories')->withSuccess('New Category Created Successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Error Creating Category']);
        }
    }

    public function edit($id)
    {
        $shopcategory = ShopCategory::findOrFail($id);
        return View('shop.category.edit',compact('shopcategory'));
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['error' => $validator->errors()]);
        }

        try {
            $shopcategory = ShopCategory::findOrFail($id);
            $shopcategory->name = $request->name;
            $shopcategory->status = $request->status;

            $file = $request->file('image');
            $imageName = time() . '-' . $file->getClientOriginalName();
            $shopcategory->image = $imageName;
            Storage::put($imageName, file_get_contents($file));

            $shopcategory->save();

            return redirect()->route('shopCategories')->withSuccess('Category Updated Successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Error Updating Category']);
        }
    }

    public function destroy($id)
    {
        $shopcategory = ShopCategory::where('category_id', $id)->first();
        $shopcategory->delete();
        $data = array('success' =>'Deleted','code'=>'200');
        return response()->json($data);
    }

}
