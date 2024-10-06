<?php

namespace App\Http\Controllers;

use App\Models\Urn;
use App\Models\User;
use App\Models\Niche;
use App\Models\Priest;
use League\Csv\Reader;
use App\Models\Building;
use App\Models\Services;
use App\Models\OwnerNiche;
use App\Models\Installment;
use App\Models\ServiceList;
use Illuminate\Http\Request;
use App\Models\PriestSchedule;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Phpml\Regression\LeastSquares;



class NicheTransactionController extends Controller
{

    public function postNicheUpdate(Request $request,$id)
    {


        $niche = Niche::with('urnInfo','buildingInfo','ownerInfo')->find($id);
        if($niche->ownerInfo)
        {
            $owner = OwnerNiche::where('id',$niche->ownerInfo->id)->update([
                'niche_id'=> $id,'birth_date'=> $request->birthdate,
                'death_date'=> $request->deathdate,
                'biography'=> $request->biography,
                'firstname'=> $request->firstname,
                'lastname'=> $request->lastname,
            ]);
            if(!!$request->owner_photo)
            {
                $filename = time().'.'.$request->owner_photo->extension();
                $request->owner_photo->storeAs('OwnerPhoto',$filename);
                $owner->update([
                    'owner_photo'=>'/storage/OwnerPhoto/'.$filename
                ]);
            }
        }else{
            $owner = OwnerNiche::create([
                'niche_id'=> $id,
                'birth_date'=> $request->birthdate,
                'death_date'=> $request->deathdate,
                'biography'=> $request->biography,
                'firstname'=> $request->firstname,
                'lastname'=> $request->lastname,
            ]);
            if(!!$request->owner_photo)
            {
                $filename = time().'.'.$request->owner_photo->extension();
                $request->owner_photo->storeAs('OwnerPhoto',$filename);
                $owner->update([
                    'owner_photo'=>'/storage/OwnerPhoto/'.$filename
                ]);
            }
        }
        return redirect('/niches/niche/'.$id.'/view')->with('success','true');
    }
    public function nicheUpdate($id)
    {
        $niche = Niche::with('urnInfo','buildingInfo','ownerInfo')->find($id);
        return view('clientview.niche.nicheEdit',compact('niche'));
    }
    public function nicheView($id)
    {
        $niche = Niche::with('urnInfo','buildingInfo','ownerInfo')->find($id);


        return view('clientview.niche.nicheView',compact('niche'));
    }
    public function index()
    {
        $buildings = Building::all();
        return View('clientview.niche.index', compact('buildings'));
    }

    public function building($id)
    {
        $building = Building::findOrFail($id);
        $niches = Niche::where('building_id', $id)->get();
        return View('clientview.niche.niches', compact('niches', 'building'));
    }

    public function niche($id)
    {
        // $niche = Niche::findOrFail($id);
        $niche = Niche::where('niche_id',$id)->first();
        $csv = Reader::createFromPath(public_path('Columbarium-Prices.csv'));
        $data = $csv->setHeaderOffset(0)->getRecords();

        $samples = [];
        $targets = [];
        foreach ($data as $row) {

            $samples[] = [(int)$row['Level'], (int)$row['Size']];
            $targets[] = (int)$row['Price'];
        }
        $regression = new LeastSquares();
        $regression->train($samples, $targets);

        $datas = [];
        $labels = [];
        $current_month = Carbon::now();
        $current_month->subMonth();
        $yers = [];
        for ($i = 1; $i <= 24 ; $i++) {

            // $prediction = $regression->predict([[(float)$curentPrice, (int)$property->land_size, (int)$property->floor_area, (int)$property->floor_number]]);
            $l = rand(1, 5);
            $s = rand(1, 5);
            $prediction = $regression->predict([[$niche->level,$niche->level]]);
            // $yers[] = $current_month + $i;



             $labels[] = $current_month->addMonth()->isoFormat('MMMM YYYY');
             $datas[] = isset($prediction[0]) ? ($prediction[0] * ($i / 100)) + $prediction[0] : null;
            // $curentPrice = isset($prediction[0]) ? ($prediction[0] * ($percent / 100)) + $prediction[0] : (float)$property->price;
        }
        return View('clientview.niche.payment', compact('niche','datas','labels'));
    }

    public function serviceView()
    {
        $services = Services::all();
        $priests = Priest::all();
        // $service = Services::findOrFail($id);
        $priests = Priest::where('status','Active')->get();
        $schedules = PriestSchedule::get();
        return View('clientview.niche.serviceview', compact('priests', 'services','schedules'));
    }

    public function nicheCheckout(Request $request)
    {

        if($request->serviceFormData){
            // $servicelist = new ServiceList();
            // $servicelist->message = $request->message;
            // $servicelist->deceasedname = $request->deceasedname;
            // $servicelist->service_id =  $id;
            // $servicelist->user_id =  auth()->id();

            // if ($request->own_priest === "on") {
            //     $servicelist->own_priest = true;
            // } else {
            //     $servicelist->priest_id = $request->priest_id;
            //     $servicelist->schedule_id = $request->schedule;
            // }



            // $servicelist->payment_mode = $request->paymentmethod;
            // $servicelist->status = 'Not Paid';

            // if($request->paymentmethod === "GCASH"){
            //     $servicelist->ref = $request->ref;

            // }

            // $servicelist->created_at = now();
            // $servicelist->save();
            $x = false;
            if ($request->serviceFormData['own_priest']) {

                $service = ServiceList::whereDate('date', Carbon::parse($request->serviceFormData['dates'])->format('Y-m-d'))->exists();
                if ($service) {
                    $x = true;
                    return response()->json(['data'=>'Service date is already exist'],400);
                }
                $service2 = PriestSchedule::whereDate('date', Carbon::parse($request->serviceFormData['dates'])->format('Y-m-d'))->where('status', true)->exists();
                if ($service2) {
                    $x = true;
                    return response()->json(['data'=>'Service date is already exist'],400);
                }
            } else {
                $check = PriestSchedule::where('id', $request->serviceFormData['schedule'])->first();
                $service = PriestSchedule::whereDate('date', Carbon::parse($check->date)->format('Y-m-d'))->where('status', true)->exists();
                if ($service) {
                    $x = true;
                    return response()->json(['data'=>'Service date is already exist'],400);
                }
                $service2 = ServiceList::whereDate('date', Carbon::parse($check->date)->format('Y-m-d'))->exists();
                if ($service2) {
                    $x = true;
                    return response()->json(['data'=>'Service date is already exist'],400);
                }
            }

            if($x == false)
            {
                $service = new ServiceList();
                // $service->start = $request->serviceFormData['startDatetime'];
                // $service->end = $request->serviceFormData['endDatetime'];
                $service->deceasedname = $request->serviceFormData['deceasedname'];
                $service->service_id = $request->serviceFormData['service_id'];
                $service->user_id = $request->user_id;

                if ($request->serviceFormData['own_priest']) {
                    $service->own_priest = true;
                } else {
                    $service->priest_id = $request->serviceFormData['priest'];
                    $service->schedule_id = $request->serviceFormData['schedule'];
                }
                $service->payment_mode = $request->paymentMethod;
                $service->status = 'Not Paid';
                $service->created_at = now();
                if ($request->paymentMethod === "GCASH") {
                    $service->ref = $request->cartRef;
                    // $service->status = 'Not Paid';
                }
                $service->save();
            }

        }
        $receiptNumber = mt_rand(1000000, 99999999);
        while (DB::table('niches')->where('receipt_id', $receiptNumber)->exists()) {
            $receiptNumber = mt_rand(1000000, 99999999);
        }

        $niche = Niche::findOrFail($request->ocmisFormData['niche_id']);
        $niche->receipt_id = $receiptNumber;
        $niche->status = 'Pending';
        $niche->user_id = $request->user_id;
        $niche->date = now();
        $niche->paymentmethod = $request->paymentMethod;
        if ($request->paymentMethod === "GCASH") {
            $niche->ref = $request->cartRef;

        }
        if ($request->ocmisFormData['paymentType'] === "installment") {
            $niche->downpayment = ((float) $request->ocmisFormData['nichePrice']) * 0.2;
            $niche->monthly = (((float) $request->ocmisFormData['nichePrice']) * 0.8) / 3;
        }
        $niche->paymenttype = $request->ocmisFormData['paymentType'];
        $niche->save();
        if($request->ocmisFormData['paymentType'] === "installment")
        {
            $now = Carbon::now();
            for( $i = 0; $i < 3; $i++ )
            {
                $now->addMonth();
                Installment::create([
                    'receipt_id'=> $receiptNumber,
                    'price'=>(((float) $request->ocmisFormData['nichePrice']) * 0.8) / 3,
                    'date'=>$now->format('Y-m-d')
                ]);


            }
        }





        Urn::where('niche_id', $request->ocmisFormData['niche_id'])->delete();
        $urnData = $request->urnData;

        if ($urnData && isset($urnData['quantity'])) {
            for ($i = 0; $i < $urnData['quantity']; $i++) {
                $urn = new Urn();
                $urn->niche_id = $request->ocmisFormData['niche_id'];
                $urn->urn_number = $i + 1;
                $urn->save();
            }
        }



        if($request->productCartItems){
            $dataOrderline = [
                'receipt_number' => $receiptNumber,
                'user_id' => $request->user_id,
                'status' => 'Pending',
                'created_at' => now(),
            ];

            $orderlineId = DB::table('product_orderline')->insertGetId($dataOrderline);

            foreach ($request->productCartItems as $item) {
                $dataOrderinfo = [
                    'orderline_id' => $orderlineId,
                    'product_id' => $item['product_id'],
                    'qty' => $item['quantity'],
                ];
                DB::table('product_orderinfo')->insert($dataOrderinfo);
            }
        }


        $user = User::findOrFail($request->user_id);
        $responseData = [
            'success' => true,
            'message' => 'Data successfully inserted.',
            'receipt_id' => $receiptNumber,
            'paymentmethod' => $request->paymentMethod,
            'paymenttype' => $request->ocmisFormData['paymentType'],
            'niches' => $request->ocmisFormData,
            'service' => $request->serviceFormData,
            'urns' => $request->urnData,
            'cartItems' =>$request->productCartItems,
            'customer' => $user,
            'date' => Carbon::parse(now())->toDateString()
        ];

        return response()->json($responseData);


    }
    public function success()
    {
        return View('clientview.niche.success');
    }
}
