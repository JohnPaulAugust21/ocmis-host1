<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Seller;

class SellerController extends Controller
{
    public function index()
    {
        return View('shop.seller.index');
    }

    public function allSellers()
    {
        $sellers = Seller::orderby('seller_id', 'ASC')->get();;
        return response()->json($sellers);
    }

    public function create()
    {
        return View('shop.seller.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'contactnumber' => 'required|string|max:255',
            'address' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['error' => $validator->errors()]);
        }

        try {
            $seller = new Seller();
            $seller->name = $request->name;
            $seller->contactnumber = $request->contactnumber;
            $seller->address = $request->address;
            $seller->status = $request->status;


            $seller->save();

            return redirect()->route('sellers')->withSuccess('New Seller Created Successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Error Creating Seller']);
        }
    }

    public function edit($id)
    {
        $seller = Seller::findOrFail($id);
        return View('shop.seller.edit',compact('seller'));
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'contactnumber' => 'required|string|max:255',
            'address' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['error' => $validator->errors()]);
        }

        try {
            $seller = Seller::findOrFail($id);
            $seller->name = $request->name;
            $seller->contactnumber = $request->contactnumber;
            $seller->address = $request->address;
            $seller->status = $request->status;


            $seller->save();

            return redirect()->route('sellers')->withSuccess('Seller Updated Successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Error Updating Seller']);
        }
    }

    

    public function destroy(string $id)
    {
        $seller = Seller::where('seller_id', $id)->first();
        $seller->delete();
        $data = array('success' =>'Deleted','code'=>'200');
        return response()->json($data);
    }


}
