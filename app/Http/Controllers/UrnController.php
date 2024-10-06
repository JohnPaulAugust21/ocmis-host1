<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Niche;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Urn;
use Illuminate\Support\Facades\DB;

class UrnController extends Controller
{
    public function index()
    {
        return View('niches.urn.index');
    }

    public function allUrns()
    {
        $urns = Urn::orderby('urn_id', 'ASC')->get();;
        return response()->json($urns);
    }

    public function create()
    {
        $result = DB::table('niches as n')
            ->select(
                'n.niche_id AS id_niche',
                'n.building_id',
                'n.niche_number',
                'n.capacity',
                'n.status',
                'n.image',
                'n.level',
                'n.paymentmethod',
                'b.name AS building_name',
                'b.image AS building_image',
                'u.niche_id',
                'u.urn_id',
                'u.urn_number',
                'u.urn_image',
                'u.message AS urn_message',
                'u.name AS deceased_name'
            )
            ->join('buildings as b', 'n.building_id', '=', 'b.building_id')
            ->leftJoin('urns as u', 'n.niche_id', '=', 'u.niche_id')
            ->get();




        return View('niches.urn.create', compact('result'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'niche_id' => 'required',
            'urn_number' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['error' => $validator->errors()]);
        }

        try {
            $urn = new Urn();
            $urn->niche_id = $request->niche_id;
            $urn->urn_number = $request->urn_number;

            $urn->save();

            return redirect()->route('urns')->withSuccess('New Urn Created Successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Error Creating Urn']);
        }
    }

    public function edit($id)
    {
        $result = DB::table('niches as n')
            ->select(
                'n.niche_id AS id_niche',
                'n.building_id',
                'n.niche_number',
                'n.capacity',
                'n.status',
                'n.image',
                'n.level',
                'n.paymentmethod',
                'b.name AS building_name',
                'b.image AS building_image',
                'u.niche_id',
                'u.urn_id',
                'u.urn_number',
                'u.urn_image',
                'u.message AS urn_message',
                'u.name AS deceased_name'
            )
            ->join('buildings as b', 'n.building_id', '=', 'b.building_id')
            ->leftJoin('urns as u', 'n.niche_id', '=', 'u.niche_id')
            ->get();

        $urn = Urn::findOrFail($id);


        return View('niches.urn.edit', compact('result', 'urn'));
    }


    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'niche_id' => 'required',
            'urn_number' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['error' => $validator->errors()]);
        }

        try {
            $urn = Urn::findOrFail($id);
            $urn->niche_id = $request->niche_id;
            $urn->urn_number = $request->urn_number;

            $urn->save();

            return redirect()->route('urns')->withSuccess('Urn Updated Successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Error Updating Urn']);
        }
    }



    public function destroy(string $id)
    {
        $urn = Urn::where('urn_id', $id)->first();
        $urn->delete();
        $data = array('success' => 'Deleted', 'code' => '200');
        return response()->json($data);
    }
}
