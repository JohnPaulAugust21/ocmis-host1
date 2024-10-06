<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Priest;
use App\Models\PriestSchedule;

class PriestController extends Controller
{
    public function index()
    {
        return View('services.priest.index');
    }

    public function allPriests()
    {
        $priests = Priest::orderby('priest_id', 'ASC')->get();;
        return response()->json($priests);
    }

    public function create()
    {
        return View('services.priest.create');
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
            $priest = new Priest();
            $priest->name = $request->name;
            $priest->contactnumber = $request->contactnumber;
            $priest->address = $request->address;
            $priest->status = $request->status;
            $priest->save();
           if($priest)
           {

            if(!!$request->schedule)
            {
                foreach( json_decode($request->schedule, true) as $key => $value )
                {

                    PriestSchedule::create([
                        'priest_id'=>$priest->priest_id,
                        'start_time'=>$value['start'],
                        'end_time'=>$value['end'],
                        'date'=>$value['date'],
                    ]);
                }
            }
            return redirect()->route('priests')->withSuccess('New Priest Created Successfully');
           }

        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Error Creating Priest']);
        }
    }

    public function edit($id)
    {
        $priest = Priest::findOrFail($id);
        $schedules = PriestSchedule::select('start_time','end_time','date')->where('priest_id',$id)->get();
        return View('services.priest.edit',compact('priest','schedules'));
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
            $priest = Priest::findOrFail($id);
            $priest->name = $request->name;
            $priest->contactnumber = $request->contactnumber;
            $priest->address = $request->address;
            $priest->status = $request->status;
            $priest->save();
            PriestSchedule::where('priest_id',$priest->priest_id)->delete();
            if($priest)
            {

             if(!!$request->schedule)
             {


                 foreach( json_decode($request->schedule, true) as $key => $value )
                 {

                     PriestSchedule::create([
                         'priest_id'=>$priest->priest_id,
                         'start_time'=>$value['start_time'],
                         'end_time'=>$value['end_time'],
                         'date'=>$value['date'],
                     ]);
                 }
             }
             return redirect()->route('priests')->withSuccess('Priest Updated Successfully');
            }

        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Error Updating Priest']);
        }
    }



    public function destroy(string $id)
    {
        PriestSchedule::where('priest_id',$id)->delete();
        $priest = Priest::where('priest_id', $id)->first();
        $priest->delete();
        $data = array('success' =>'Deleted','code'=>'200');
        return response()->json($data);
    }

}
