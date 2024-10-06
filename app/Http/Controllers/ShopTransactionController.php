<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Mail\Refund;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendReceipt;


class ShopTransactionController extends Controller
{
    public function cancelPurchases($id)
    {
        $product = DB::table('product_orderline')->where('orderline_id', $id)->first();
        if ($product->status == 'Completed') {
            $data = [
                'name' => Auth::user()->firstname . ' ' . Auth::user()->lastname
            ];
            Mail::to(Auth::user()->email)->send(new Refund($data));
            Mail::to('onlinecolumbariumsystem@gmail.com')->send(new Refund($data));
            $product = DB::table('product_orderline')->where('orderline_id', $id)->update([
                'status' => 'Cancelled'
            ]);
        }else{
            $product = DB::table('product_orderline')->where('orderline_id', $id)->update([
                'status' => 'Cancelled'
            ]);
        }
        return back();
    }
    public function index()
    {

        return view('clientview.shop.index');
    }

    public function allItems()
    {
        $items = Product::join('shop_categories', 'products.category_id', 'shop_categories.category_id')
            ->select('products.*', 'shop_categories.name as category')
            ->orderBy('product_id', 'DESC')->get();
        return response()->json($items);
    }

    public function checkout(Request $request)
    {
        $receiptNumber = mt_rand(1000000, 99999999);
        while (DB::table('product_orderline')->where('receipt_number', $receiptNumber)->exists()) {
            $receiptNumber = mt_rand(1000000, 99999999);
        }

        $dataOrderline = [
            'receipt_number' => $receiptNumber,
            'user_id' => $request->user_id,
            'status' => 'Pending',
            'created_at' => now(),
        ];

        $orderlineId = DB::table('product_orderline')->insertGetId($dataOrderline);


        foreach ($request->cartItems as $item) {
            $dataOrderinfo = [
                'orderline_id' => $orderlineId,
                'product_id' => $item['product_id'],
                'qty' => $item['quantity'],
            ];
            DB::table('product_orderinfo')->insert($dataOrderinfo);
        }

        $user = User::findOrFail($request->user_id);
        $responseData = [
            'success' => true,
            'message' => 'Data successfully inserted.',
            'orderlineId' => $receiptNumber,
            'cartItems' => $request->cartItems,
            'customer' => $user,
            'date' => Carbon::parse(now())->toDateString()
        ];

        return response()->json($responseData);
    }

    public function shopTransactionView()
    {
        return View('shop.transaction');
    }

    public function shopTransactionList()
    {

        $transcations = DB::table('product_orderline as pol')
            ->join('product_orderinfo as poi', 'pol.orderline_id', 'poi.orderline_id')
            ->join('products as p', 'poi.product_id', 'p.product_id')
            ->select('pol.*', 'p.name', 'p.price', 'poi.qty')
            ->get();

        return response()->json($transcations);
    }

    public function switchStatus($id)
    {
        $transaction = DB::table('product_orderline')->where('orderline_id', $id)->first();

        $stocksTable = DB::table('products')
                    ->join('product_orderinfo', 'products.product_id', '=', 'product_orderinfo.product_id')
                    ->join('product_orderline', 'product_orderinfo.orderline_id', '=', 'product_orderline.orderline_id')
                    ->join('users','users.id','product_orderline.user_id')
                    ->select('products.stock', 'product_orderinfo.qty','users.email','users.firstname','users.lastname')
                    ->where('product_orderline.orderline_id', $id)
                    ->first();
        
        // dd($stocks->stock, $stocks->qty);

        $stocks = $stocksTable->stock;
        $quantity = $stocksTable->qty;
        // dd($quantity);

        if (!$transaction) {
            // Handle the case where the transaction with the given ID is not found.
            $data = array('success' => false, 'code' => '404', 'message' => 'Transaction not found');
            return response()->json($data, 404);
        }

        if ($transaction->status === "Pending") {
            $data = [
                'name' => $stocksTable->firstname . ' ' . $stocksTable->lastname
            ];
            $products = DB::table('products')
            ->join('product_orderinfo', 'products.product_id', '=', 'product_orderinfo.product_id')
            ->join('product_orderline', 'product_orderinfo.orderline_id', '=', 'product_orderline.orderline_id')
            ->join('users','users.id','product_orderline.user_id')
            ->select('products.*', 'product_orderinfo.qty', 'users.email', 'users.firstname', 'users.lastname')
            ->where('product_orderline.orderline_id', $id)
            ->get();
            
            Mail::to($stocksTable->email)->send(new SendReceipt($data, $products));
            $newStock = $stocks - $quantity;
            $stocksTable = DB::table('products')
                    ->join('product_orderinfo', 'products.product_id', '=', 'product_orderinfo.product_id')
                    ->join('product_orderline', 'product_orderinfo.orderline_id', '=', 'product_orderline.orderline_id')
                    ->join('users','users.id','product_orderline.user_id')
                    ->select('products.stock', 'product_orderinfo.qty','users.email','users.firstname','users.lastname')
                    ->where('product_orderline.orderline_id', $id)
                    ->update(['products.stock' => $newStock]);
            $newStatus = "Completed";
        } elseif ($transaction->status === "Completed") {
            $newStock = $stocks + $quantity;
            $data = [
                'name' => $stocksTable->firstname . ' ' . $stocksTable->lastname
            ];
            $products = DB::table('products')
            ->join('product_orderinfo', 'products.product_id', '=', 'product_orderinfo.product_id')
            ->join('product_orderline', 'product_orderinfo.orderline_id', '=', 'product_orderline.orderline_id')
            ->join('users','users.id','product_orderline.user_id')
            ->select('products.*', 'product_orderinfo.qty', 'users.email', 'users.firstname', 'users.lastname')
            ->where('product_orderline.orderline_id', $id)
            ->get();
            
            Mail::to($stocksTable->email)->send(new SendReceipt($data, $products));
            $stocksTable = DB::table('products')
                    ->join('product_orderinfo', 'products.product_id', '=', 'product_orderinfo.product_id')
                    ->join('product_orderline', 'product_orderinfo.orderline_id', '=', 'product_orderline.orderline_id')
                    ->join('users','users.id','product_orderline.user_id')
                    ->select('products.stock', 'product_orderinfo.qty','users.email','users.firstname','users.lastname')
                    ->where('product_orderline.orderline_id', $id)
                    ->update(['products.stock' => $newStock]);
            $newStatus = "Cancelled";
        } else {
            $newStatus = "Pending";
        }

        // Update the database record with the new status
        DB::table('product_orderline')->where('orderline_id', $id)->update(['status' => $newStatus]);

        $data = array('success' => true, 'code' => '200');
        return response()->json($data);
    }

    public function shopTransactionListUser()
    {

        $transcations = DB::table('product_orderline as pol')
            ->join('product_orderinfo as poi', 'pol.orderline_id', 'poi.orderline_id')
            ->join('products as p', 'poi.product_id', 'p.product_id')
            ->where('pol.user_id', auth()->id())
            ->select('pol.*', 'p.name', 'p.price', 'poi.qty')

            ->get();

        return response()->json($transcations);
    }
}
