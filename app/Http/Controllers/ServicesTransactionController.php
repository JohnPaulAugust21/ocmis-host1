<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Priest;
use App\Models\Services;
use App\Models\ServiceList;
use Illuminate\Http\Request;
use App\Models\PriestSchedule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ServicesTransactionController extends Controller
{
    public function index()
    {
        $services = Services::where('status', 'Active')->get();
        return view('clientview.services.index', compact('services'));
    }

    public function payment($id)
    {

        $service = Services::findOrFail($id);
        $priests = Priest::where('status', 'Active')->get();
        $schedules = PriestSchedule::get();
        return view('clientview.services.payment', compact('service', 'priests', 'schedules'));
    }

    public function postPayment(Request $request, $id)
    {

        if ($request->own_priest) {
            $service = ServiceList::whereDate('date', Carbon::parse($request->date)->format('Y-m-d'))->exists();
            if ($service) {
                return redirect()->back()->withErrors(['errors' => 'date is already exist']);
            }
            $service2 = PriestSchedule::whereDate('date', Carbon::parse($request->date)->format('Y-m-d'))->where('status', true)->exists();
            if ($service2) {
                return redirect()->back()->withErrors(['errors' => 'date is already exist']);
            }
        } else {
            $check = PriestSchedule::where('id', $request->schedule)->first();
            $service = PriestSchedule::whereDate('date', Carbon::parse($check->date)->format('Y-m-d'))->where('status', true)->exists();
            if ($service) {
                return redirect()->back()->withErrors(['errors' => 'date is already exist']);
            }
            $service2 = ServiceList::whereDate('date', Carbon::parse($check->date)->format('Y-m-d'))->exists();
            if ($service2) {
                return redirect()->back()->withErrors(['errors' => 'date is already exist']);
            }
        }

        // $validator = Validator::make($request->all(), [
        //     'deceasedname' => 'required',
        //     'message' => 'required',
        //     'start_datetime' => 'required',
        //     'end_datetime' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors(['errors' => $validator->errors()]);
        // }


        try {
            $servicelist = new ServiceList();
            $servicelist->message = $request->message;
            $servicelist->deceasedname = $request->deceasedname;
            $servicelist->service_id =  $id;
            $servicelist->user_id =  auth()->id();

            if ($request->own_priest === "on") {
                $servicelist->own_priest = true;
                $servicelist->date = $request->date;
            } else {
                $servicelist->priest_id = $request->priest_id;
                $servicelist->schedule_id = $request->schedule;
                PriestSchedule::where('id', $request->schedule)->update(['status' => true]);
            }



            $servicelist->payment_mode = $request->paymentmethod;
            $servicelist->status = 'Not Paid';

            if ($request->paymentmethod === "GCASH") {
                                // $servicelist->ref = $request->ref;
                                $files = $request->file('ref');
                                $servicelist->ref = ''.time().'-'.$files->getClientOriginalName();
                                // $venues->save();
                                Storage::put('public/images/'.time().'-'.$files->getClientOriginalName(), file_get_contents($files));
                            }

            $servicelist->created_at = now();
            $servicelist->save();



            return redirect()->route('serviceSuccess');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['errors' => 'Error Creating Service']);
        }
    }

    public function success()
    {
        return view('clientview.services.success');
    }
}
