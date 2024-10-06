<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memorial;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class MemorialTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $memorials = Memorial::where('status', 'Pending')->get();
        return view('services.memorial.index', compact('memorials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function allMemorialsList()
    {
        // $serviceList = ServiceList::leftJoin('service_categories','service_categories.service_id','service_list.service_id')
        // ->leftJoin('users','service_list.user_id','users.id')
        // ->select('service_list.*','service_categories.name','users.firstname','users.lastname')
        // ->orderby('id', 'DESC')->get();
        $memorials = Memorial::with('userInfo')->orderby('memorial_id', 'DESC')->get();
        return response()->json($memorials);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // $validator = Validator::make($request->all(), [
        //     'service_category_id' => 'required',
        //     'start_datetime' => 'required',
        //     'end_datetime' => 'required',
        //     'price' => 'required',
        //     'status' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors(['error' => $validator->errors()]);
        // }

        // try {
        //     $memorial = new Memorial();
        //     $memorial->service_id = $request->service_category_id;
        //     $memorial->start = $request->start_datetime;
        //     $memorial->end = $request->end_datetime;
        //     $memorial->price = $request->price;
        //     $memorial->status = $request->status;

        //     $memorial->save();

        //     return redirect()->route('serviceList')->withSuccess('New Service  Created Successfully');
        // } catch (\Exception $e) {

        //     return redirect()->back()->withErrors(['error' => 'Error Creating Service']);
        // }
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
        //
        $memorials = Memorial::all();
        // $servicelist = ServiceList::findOrFail($id);
        return View('services.memorial.edit', compact('memorials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $memorials = Memorial::findOrFail($id);
        $memorials->status = 'Completed';
        $memorials->update();

        return response()->json($memorials);
    }

    public function cancel(Request $request, string $id)
    {
        //
        $memorials = Memorial::findOrFail($id);
        $memorials->status = 'Cancelled';
        $memorials->update();

        return response()->json($memorials);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
