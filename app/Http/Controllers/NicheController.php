<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Niche;
use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NicheController extends Controller
{

    public function adminNiches()
    {
        $niche = Niche::join('buildings', 'niches.building_id', 'buildings.building_id')
        ->select('niches.*','buildings.name')
        ->whereDate('niches.date', Carbon::now()->format('Y-m-d'))
        ->where(function ($query) {
            $query->where('niches.status', 'Occupied');

        })
        ->get();

        return response()->json($niche);
    }
    public function index()
    {
        return View('niches.niche.index');
    }

    public function allNiches()
    {
        // $niche = Niche::orderby('building_id','ASC')->get();

        $niche = Niche::join('buildings', 'niches.building_id','buildings.building_id')
        ->select('niches.*', 'buildings.name')
        ->get();

        return response()->json($niche);
    }

    public function create()
    {
        $buildings = Building::orderBy('building_id','ASC')->get();
        return View('niches.niche.create',compact('buildings'));
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'niche_number' => 'required|integer',
            'building_id' => 'required',
            'capacity' => 'required|integer',
            'level_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['error' => $validator->errors()]);
        }

        try {
            $niche = new Niche();
            $niche->niche_number = $request->niche_number;
            $niche->building_id = $request->building_id;
            $niche->capacity = $request->capacity;
            $niche->level = $request->level_id;
            $niche->status = $request->status;

            switch ($request->level_id) {
                case 1:
                    $niche->price = 50000;
                    break;
                case 2:
                    $niche->price = 55000;
                    break;
                case 3:
                case 4:
                case 5:
                    $niche->price = 60000;
                    break;
                case 6:
                    $niche->price = 550000;
                    break;
                default:
                    $niche->price = 50000;
                    break;
            }



            $file = $request->file('image');
            $imageName = time() . '-' . $file->getClientOriginalName();
            $niche->image = $imageName;
            Storage::put($imageName, file_get_contents($file));

            $niche->save();

            return redirect()->route('niches')->withSuccess('New Niche Created Successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Error Creating Niche']);
        }
    }

    public function edit($id)
    {
        $buildings = Building::orderBy('building_id','ASC')->get();
        $niche = Niche::findOrFail($id);
        return View('niches.niche.edit',compact('buildings','niche'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'niche_number' => 'required|integer',
            'building_id' => 'required',
            'capacity' => 'required|integer',
            'level_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['error' => $validator->errors()]);
        }

        try {
            $niche = Niche::where('niche_id',$id)->first();
            $niche->niche_number = $request->niche_number;
            $niche->building_id = $request->building_id;
            $niche->capacity = $request->capacity;
            $niche->level = $request->level_id;
            $niche->status = $request->status;

            switch ($request->level_id) {
                case 1:
                    $niche->price = 50000;
                    break;
                case 2:
                    $niche->price = 55000;
                    break;
                case 3:
                case 4:
                case 5:
                    $niche->price = 60000;
                    break;
                case 6:
                    $niche->price = 550000;
                    break;
                default:
                    $niche->price = 50000;
                    break;
            }



            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '-' . $file->getClientOriginalName();
                $niche->image = $imageName;
                Storage::put($imageName, file_get_contents($file));
            }

            $niche->save();

            return redirect()->route('niches')->withSuccess('Niche Updated Successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Error Creating Niche']);
        }
    }

    public function destroy($id)
    {
        $niche = Niche::where('niche_id', $id)->first();
        $niche->delete();
        $data = array('success' =>'Deleted','code'=>'200');
        return response()->json($data);
    }
}
