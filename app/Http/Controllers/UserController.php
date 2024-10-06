<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Niche;
use League\Csv\Reader;
use App\Models\Building;
use App\Models\ServiceList;
use Illuminate\Http\Request;
use Phpml\Regression\LeastSquares;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

    public function forecastSale()
    {
        return view('forecast.sales');
    }
    public function forecastShopSales()
    {
        $transcations = DB::table('product_orderline as pol')
        ->join('product_orderinfo as poi', 'pol.orderline_id', 'poi.orderline_id')
        ->join('products as p', 'poi.product_id', 'p.product_id')
        ->whereDate('pol.created_at', Carbon::now()->format('Y-m-d'))
        ->where('pol.status' ,'Completed')

        ->select('pol.*', 'p.name', 'p.price', 'poi.qty')
        ->get();
        return response()->json($transcations);
    }
    public function forecastServicesSales()
    {
        // ->where('status','Paid')
        $serviceList = ServiceList::with('categoryInfo')->with('priestInfo','scheduleInfo')->whereDate('created_at', Carbon::now()->format('Y-m-d'))->where('status','Paid')->orderby('id', 'DESC')->get();

        return response()->json($serviceList,200);
    }
    public function forecastBuilding($id)
    {
        $niches = Niche::where('building_id',$id)->get();
        $building = Building::where('building_id',$id)->first();

        return view('forecast.forecastBuilding',compact('niches','building'));
    }
    public function forecastNiche($id)
    {
        // dd($id);
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

        return view('forecast.forecastNich',compact('datas','labels'));
    }
    public function forecast()
    {
        // $csv = Reader::createFromPath(public_path('Columbarium-Prices.csv'));
        // $data = $csv->setHeaderOffset(0)->getRecords();

        // $samples = [];
        // $targets = [];
        // foreach ($data as $row) {

        //     $samples[] = [(int)$row['Level'], (int)$row['Size']];
        //     $targets[] = (int)$row['Price'];
        // }
        // $regression = new LeastSquares();
        // $regression->train($samples, $targets);

        // $datas = [];
        // $labels = [];
        // $current_month = Carbon::now();
        // $current_month->subMonth();
        // $yers = [];
        // for ($i = 1; $i <= 24 ; $i++) {

        //     // $prediction = $regression->predict([[(float)$curentPrice, (int)$property->land_size, (int)$property->floor_area, (int)$property->floor_number]]);
        //     $l = rand(1, 5);
        //     $s = rand(1, 5);
        //     $prediction = $regression->predict([[$l,$s]]);
        //     // $yers[] = $current_month + $i;



        //      $labels[] = $current_month->addMonth()->isoFormat('MMMM YYYY');
        //      $datas[] = isset($prediction[0]) ? $prediction[0] : null;
        //     // $curentPrice = isset($prediction[0]) ? ($prediction[0] * ($percent / 100)) + $prediction[0] : (float)$property->price;
        // }
        $buildings = Building::get();
        return view('forecast.index',compact('buildings'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return View('users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function allUsers()
    {
         $users = User::orderby('id','ASC')->get();;
        return response()->json($users);
    }
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
