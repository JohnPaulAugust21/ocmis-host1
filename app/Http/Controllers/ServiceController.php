<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function index()
    {
        return View('services.category.index');
    }

    public function allServices()
    {
        $service = Services::orderby('service_id', 'ASC')->get();;
        return response()->json($service);
    }

    public function create()
    {
        return View('services.category.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['error' => $validator->errors()]);
        }

        try {
            $service = new Services();
            $service->name = $request->name;
            $service->status = $request->status;
            $service->price = $request->price;

            $file = $request->file('image');
            $imageName = time() . '-' . $file->getClientOriginalName();
            $service->image = $imageName;
            Storage::put($imageName, file_get_contents($file));

            $service->save();

            return redirect()->route('services')->withSuccess('New Service Category Created Successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Error Creating Service Category']);
        }
    }

    public function edit($id)
    {
        $service = Services::findOrFail($id);
        return View('services.category.edit',compact('service'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['error' => $validator->errors()]);
        }

        try {
            $service = Services::findOrFail($id);
            $service->name = $request->name;
            $service->status = $request->status;
            $service->price = $request->price;

            $file = $request->file('image');
            $imageName = time() . '-' . $file->getClientOriginalName();
            $service->image = $imageName;
            Storage::put($imageName, file_get_contents($file));

            $service->save();

            return redirect()->route('services')->withSuccess('Service Category Updated Successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Error Updating Service Category']);
        }
    }

    public function destroy($id)
    {
        $service = Services::where('service_id', $id)->first();
        $service->delete();
        $data = array('success' =>'Deleted','code'=>'200');
        return response()->json($data);
    }

}
