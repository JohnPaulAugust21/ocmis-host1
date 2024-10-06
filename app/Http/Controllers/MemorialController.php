<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Memorial;
use Illuminate\Http\Request;
use Jubaer\Zoom\Facades\Zoom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class MemorialController extends Controller
{
    public function index()
    {
        $memorials = Memorial::all();
        return View('clientview.memorial.index', compact('memorials'));
    }

    public function create()
    {
        return View('clientview.memorial.create');
    }

    public function store(Request $request)
    {

        $paymentMethod = $request->paymentmethodMemorial;
        $time = $request->date_time;
        $start_time = Carbon::parse(explode('T',$time)[0].' '.explode('T',$time)[1], 'Asia/Singapore')->toIso8601String();


        // dd(new Carbon(explode('T',$time)[0].' '.explode('T',$time)[1]));
        $validator = Validator::make($request->all(), [
            'deceasedName' => 'required|string|max:255',
            'message' => 'required',
            'date_time' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['error' => $validator->errors()]);
        }
        
        try {
            $meetings = Zoom::createMeeting([
                'agenda'=>$request->message,
                "topic" => $request->deceasedName,
                // 1 => instant, 2 => scheduled, 3 => recurring with no fixed time, 8 => recurring with fixed time
                "timezone" => 'Asia/Singapore',
                "pre_schedule" => false,

                "start_time" =>$start_time, // set your start time
                "settings" => [
                    'join_before_host' => false, // if you want to join before host set true otherwise set false
                    'host_video' => false, // if you want to start video when host join set true otherwise set false
                    'participant_video' => false, // if you want to start video when participants join set true otherwise set false
                    'mute_upon_entry' => false, // if you want to mute participants when they join the meeting set true otherwise set false
                    'waiting_room' => true, // if you want to use waiting room for participants set true otherwise set false
                    'audio' => 'both', // values are 'both', 'telephony', 'voip'. default is both.
                    'auto_recording' => 'none', // values are 'none', 'local', 'cloud'. default is none.
                    'approval_type' => 0, // 0 => Automatically Approve, 1 => Manually Approve, 2 => No Registration Required
                ],

            ]);


            // $memorialId = DB::table('memorials')->insertGetId([
            //     'deceasedname' => $request->deceasedName,
            //     'message' => $request->message,
            //     'date_time' => $request->date_time,
            //     'link' => $meetings['data']['join_url'],
            //     'password'=> $meetings['data']['password'],
            //     'location' => $request->location,
            //     'user_id' => auth()->id(),
            // ]);

            if ($paymentMethod === 'CASH'){
                $memorialId = DB::table('memorials')->insertGetId([
                    'payment_mode' => 'CASH',
                    'deceasedname' => $request->deceasedName,
                    'message' => $request->message,
                    'date_time' => $request->date_time,
                    'link' => $meetings['data']['join_url'],
                    'password'=> $meetings['data']['password'],
                    'price' => 1000,
                    'ref' => 'CASH',
                    'user_id' => auth()->id(),
                    'status' => 'Pending'
                ]);
            }
            else{
                $files = $request->file('refImage');
                // $venues->image = 'images/'.time().'-'.$files->getClientOriginalName();
                
                $memorialId = DB::table('memorials')->insertGetId([
                    'payment_mode' => 'GCASH',
                    'deceasedname' => $request->deceasedName,
                    'message' => $request->message,
                    'date_time' => $request->date_time,
                    'link' => $meetings['data']['join_url'],
                    'password'=> $meetings['data']['password'],
                    'price' => 1000,
                    'ref' => ''.time().'-'.$files->getClientOriginalName(),
                    'user_id' => auth()->id(),
                    'status' => 'Pending'
                ]);
                Storage::put('public/images/'.time().'-'.$files->getClientOriginalName(), file_get_contents($files));
            }


            foreach ($request->file('images') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();

                DB::table('memorial_images')->insert([
                    'memorial_id' => $memorialId,
                    'image' => $imageName,
                ]);
                Storage::put($imageName, file_get_contents($image));
            }

            return redirect()->route('memorials')->withSuccess('New Memorial Created Successfully');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error Creating Memorial']);
        }
    }

    public function memorialView($id)
    {
        $memorial = Memorial::findOrFail($id);
        $images = DB::table('memorial_images')->where('memorial_id',$id)->get();

        return View('clientview.memorial.memorialview',compact('memorial','images'));
    }


    public function myMemorials()
    {
        $memorials = Memorial::orderby('memorial_id', 'ASC')->get();;
        return response()->json($memorials);
    }

    public function cancelPurchasesMemorial(string $id)
    {

        $memorial = DB::table('memorials')->where('memorial_id', $id)->first();
        if ($memorial) {
            DB::table('memorials')->where('memorial_id', $id)->update([
                'status' => 'Denied',
                'payment_mode' => 'Cancelled'
            ]);
        }
        return redirect()->route('myRequests');

    }

    // public function checkIfDone($id)
    // {
    //     $memorial = Memorial::findOrFail($id);
    //     $images = DB::table('memorial_images')->where('memorial_id',$id)->get();

    //     return View('clientview.memorial.memorialview',compact('memorial','images'));
    // }
}
