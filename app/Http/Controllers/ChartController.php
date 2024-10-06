<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function shopSales()
    {
        return View('shop.sales');
    }

    public function weeklyShopSales()
    {
        $sales = DB::table('product_orderinfo as po')
            ->join('product_orderline as pol', 'po.orderline_id', '=', 'pol.orderline_id')
            ->select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as dayname"))
            ->whereYear('created_at', date('Y'))
            ->groupBy('dayname')
            ->pluck('count', 'dayname');
        $labels = $sales->keys();
        $data = $sales->values();
        return response()->json(array('data' => $data, 'labels' => $labels));
    }

    public function topProduct()
    {
        $sales = DB::table('products as p')
            ->join('product_orderinfo as o', 'p.product_id', 'o.product_id')
            ->groupBy('p.name')
            ->orderBy('total')
            ->pluck(DB::raw('count(p.product_id) as total'), 'p.name')->all();

        $labels = (array_keys($sales));

        $data = array_values($sales);

        return response()->json(array('data' => $data, 'labels' => $labels));
    }

    public function serviceSales()
    {
        return View('services.sales');
    }

    public function topService()
    {
        $status = DB::table('service_list as sl')
            ->join('service_categories as sc', 'sl.service_id', 'sc.service_id')
            ->groupBy('sc.name')->orderBy('total')
            ->pluck(DB::raw('count(sc.name) as total'), 'sc.name')->all();
        $labels = (array_keys($status));
        $data = array_values($status);
        return response()->json(array('data' => $data, 'labels' => $labels));
    }

    public function dailySalesService()
    {
        $sales = DB::table('service_list')
            ->select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as dayname"))
            ->whereYear('created_at', date('Y'))
            ->groupBy('dayname')
            ->pluck('count', 'dayname');
        $labels = $sales->keys();
        $data = $sales->values();
        return response()->json(array('data' => $data, 'labels' => $labels));
    }

    public function nichesSales()
    {
        return View('niches.sales');
    }

    public function nicheStatus()
    {
        $status = DB::table('niches')
            ->groupBy('status')->orderBy('total')
            ->pluck(DB::raw('count(status) as total'), 'status')->all();
        $labels = (array_keys($status));
        $data = array_values($status);
        return response()->json(array('data' => $data, 'labels' => $labels));
    }

    public function forecasting()
    {
        $monthlySalesData = [];

        // Generate dummy data for monthly sales from Jan 2024 to Dec 2025
        $currentYear = 2024;
        $endYear = 2025;

        while ($currentYear <= $endYear) {
            $currentMonth = 1;
            while ($currentMonth <= 12) {
                $monthName = date('F', mktime(0, 0, 0, $currentMonth, 1));
                $monthlySalesData[$monthName . ' ' . $currentYear] = rand(5000, 100000);
                $currentMonth++;
            }
            $currentYear++;
        }

        $labels = array_keys($monthlySalesData);
        $data = array_values($monthlySalesData);

        return response()->json(['data' => $data, 'labels' => $labels]);
    }
}
