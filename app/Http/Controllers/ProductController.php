<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\ShopCategory;
use App\Models\Seller;

class ProductController extends Controller
{
    public function index()
    {
        return View('shop.product.index');
    }

    public function allProducts()
    {
        $product = Product::join('shop_categories','products.category_id','shop_categories.category_id')
        ->join('shop_sellers','products.seller_id','shop_sellers.seller_id')
        ->select('products.*','shop_categories.name as cname','shop_sellers.name as sname')
        ->get();
        return response()->json($product);
    }

    public function create()
    {
        $seller = Seller::all();
        $category = ShopCategory::all();
        return View('shop.product.create',compact('seller','category'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'quantity' => 'required',
            'price' => 'required',
            'status' => 'required',
            'seller_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['error' => $validator->errors()]);
        }
        try {
            $product = new Product();
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->stock = $request->quantity;
            $product->price = $request->price;
            $product->status = $request->status;
            $product->seller_id = $request->seller_id;
    
            $file = $request->file('image');
            $imageName = time() . '-' . $file->getClientOriginalName();
            $product->image = $imageName;
            Storage::put($imageName, file_get_contents($file));

            $product->save();

            return redirect()->route('products')->withSuccess('New Product Created Successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Error Creating Product']);
        }
    }

    public function edit($id)
    {
        $seller = Seller::all();
        $category = ShopCategory::all();
        $product = Product::findOrFail($id);
        return View('shop.product.edit',compact('seller','category','product'));
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'quantity' => 'required',
            'price' => 'required',
            'status' => 'required',
            'seller_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['error' => $validator->errors()]);
        }
        try {
            $product = Product::findOrFail($id);
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->stock = $request->quantity;
            $product->price = $request->price;
            $product->status = $request->status;
            $product->seller_id = $request->seller_id;
    
            $file = $request->file('image');
            $imageName = time() . '-' . $file->getClientOriginalName();
            $product->image = $imageName;
            Storage::put($imageName, file_get_contents($file));

            $product->save();

            return redirect()->route('products')->withSuccess('Product Updated Successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Error Updating Product']);
        }
    }

    public function destroy(string $id)
    {
        $product = Product::where('product_id', $id)->first();
        $product->delete();
        $data = array('success' =>'Deleted','code'=>'200');
        return response()->json($data);
    }
}
