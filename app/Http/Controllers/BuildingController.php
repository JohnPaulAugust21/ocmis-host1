<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Building;
use Illuminate\Support\Facades\Validator;


class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return View('niches.building.index');
    }

    public function allBuildings()
    {
        $building = Building::orderby('building_id', 'ASC')->get();;
        return response()->json($building);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View('niches.building.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['error' => $validator->errors()]);
        }

        try {
            $building = new Building();
            $building->name = $request->name;


            $file = $request->file('image');
            $imageName = time() . '-' . $file->getClientOriginalName();
            $building->image = $imageName;
            Storage::put($imageName, file_get_contents($file));

            $building->save();

            return redirect()->route('buildings')->withSuccess('New Building Created Successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Error Creating Building']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        $building = Building::findOrFail($id);
        return view('niches.building.edit', compact('building'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'new_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['error' => $validator->errors()]);
        }

        try {
            $building = Building::findOrFail($id);
            $building->name = $request->name;
            $file = $request->file('new_image');
            $imageName = time() . '-' . $file->getClientOriginalName();
            $building->image = $imageName;
            Storage::put($imageName, file_get_contents($file));

            $building->save();

            return redirect()->route('buildings')->withSuccess('Building Updated Successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Error Updating Building']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $building = Building::where('building_id', $id)->first();
        $building->delete();
        $data = array('success' =>'Deleted','code'=>'200');
        return response()->json($data);
    }
}
