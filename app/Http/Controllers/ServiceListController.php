<?php

namespace App\Http\Controllers;

use \DB;
use App\Mail\Refund;
use App\Mail\SendReceiptServices;
use App\Models\Services;
use App\Models\ServiceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ServiceListController extends Controller
{

    public function cancelService(ServiceList $id)
    {
        if($id->status == 'Paid')
        {
            $data = [
                'name'=>Auth::user()->firstname.' '.Auth::user()->lastname
            ];
            Mail::to(Auth::user()->email)->send(new Refund($data));
            Mail::to('onlinecolumbariumsystem@gmail.com')->send(new Refund($data));
            $id->update(
                [
                    'status'=>'Cancelled'
                ]
                );
        }else{
            $id->update(
                [
                    'status'=>'Cancelled'
                ]
                );
        }

        return back();
    }
    public function index()
    {
        return View('services.serviceList.index');
    }

    public function allServiceList()
    {
        // $serviceList = ServiceList::leftJoin('service_categories','service_categories.service_id','service_list.service_id')
        // ->leftJoin('users','service_list.user_id','users.id')
        // ->select('service_list.*','service_categories.name','users.firstname','users.lastname')
        // ->orderby('id', 'DESC')->get();
        $serviceList = ServiceList::with('categoryInfo','priestInfo','scheduleInfo','userInfo')->orderby('id', 'DESC')->get();
        return response()->json($serviceList);

    }

    public function create()
    {
        $categories = Services::all();

        return View('services.serviceList.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'service_category_id' => 'required',
            'start_datetime' => 'required',
            'end_datetime' => 'required',
            'price' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['error' => $validator->errors()]);
        }

        try {
            $servicelist = new ServiceList();
            $servicelist->service_id = $request->service_category_id;
            $servicelist->start = $request->start_datetime;
            $servicelist->end = $request->end_datetime;
            $servicelist->price = $request->price;
            $servicelist->status = $request->status;

            $servicelist->save();

            return redirect()->route('serviceList')->withSuccess('New Service  Created Successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Error Creating Service']);
        }
    }

    public function edit($id)
    {
        $categories = Services::all();
        $servicelist = ServiceList::findOrFail($id);

        return View('services.serviceList.edit', compact('categories','servicelist'));
    }

    public function update(Request $request,$id)
    {

        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['error' => $validator->errors()]);
        }

        // $service_list = ServiceList::join('service_categories', 'service_categories.service_id', 'service_list.service_id')
        //                             ->where('service_list.id', $id)
        //                             ->first();
        // if ($service_list === null || !is_object($service_list)) {
        //     // Handle the case where no service list is found or the result is unexpected
        //     $service_list = [];
        // }  
        // // dd($service_list);
        // $user = User::where('id',$service_list->user_id)->first();
        // $email = $user->email;
        // // dd($email);
        // $servicelist = ServiceList::findOrFail($id);
        // $servicelist->status = $request->status;
        // $data = [
        //     'name' => $user->firstname.' '.$user->lastname
        // ];
        
        // $service_list = ServiceList::join('service_categories', 'service_categories.service_id', 'service_list.service_id')
        //     ->where('service_list.id', $id)
        //     ->get(); // Assuming you want to get all services for the order
        
        // Mail::to($email)->send(new SendReceiptServices($data, $service_list));
        // $servicelist->save();

        // return redirect()->route('serviceList')->withSuccess('Service Updated Successfully');

        try {
            $service_list = ServiceList::join('service_categories', 'service_categories.service_id', 'service_list.service_id')
                                    ->where('service_list.id', $id)
                                    ->first();
            if ($service_list === null || !is_object($service_list)) {
                // Handle the case where no service list is found or the result is unexpected
                $service_list = [];
            }  
            // dd($service_list);
            $user = User::where('id',$service_list->user_id)->first();
            $email = $user->email;
            // dd($email);
            $servicelist = ServiceList::findOrFail($id);
            $servicelist->status = $request->status;
            $data = [
                'name' => $user->firstname.' '.$user->lastname
            ];
            
            $service_list = ServiceList::join('service_categories', 'service_categories.service_id', 'service_list.service_id')
                ->where('service_list.id', $id)
                ->get(); // Assuming you want to get all services for the order
            
            Mail::to($email)->send(new SendReceiptServices($data, $service_list));
            $servicelist->save();

            return redirect()->route('serviceList')->withSuccess('Service Updated Successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Error Updating Service']);
        }
    }

    public function destroy($id)
    {
        $servicelist = ServiceList::where('id', $id)->first();
        $servicelist->delete();
        $data = array('success' => 'Deleted', 'code' => '200');
        return response()->json($data);
    }

    public function myRequests()
    {
        return View('clientview.transactions.myrequest');
    }

    public function allRequests()
    {
        $serviceList = ServiceList::with('categoryInfo','priestInfo','scheduleInfo')->where('user_id',auth()->id())->orderby('id', 'DESC')->get();
        return response()->json($serviceList);
    }

    public function getReceipt($id)
    {
        $serviceListPhoto = ServiceList::with('categoryInfo','priestInfo','scheduleInfo')->where('id',$id)->first();
        return response()->json($serviceListPhoto);
    }
}
