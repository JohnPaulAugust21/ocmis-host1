<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\NicheController;
use App\Http\Controllers\UrnController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceListController;
use App\Http\Controllers\ShopCategoryController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopTransactionController;
use App\Http\Controllers\ServicesTransactionController;
use App\Http\Controllers\PriestController;
use App\Http\Controllers\NicheTransactionController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\UsersHistoryController;
use App\Http\Controllers\MemorialTransactionController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/all-users', [UserController::class, 'allUsers'])->name('allUsers');
Route::get('/all-buildings', [BuildingController::class, 'allBuildings'])->name('allBuildings');
Route::delete('/delete-building/{id}', [BuildingController::class, 'destroy'])->name('deleteBuilding');

Route::get('/all-niches', [NicheController::class, 'allNiches'])->name('allNiches');
Route::delete('/delete-niche/{id}', [NicheController::class, 'destroy'])->name('deleteNiche');

Route::get('/all-urns', [UrnController::class, 'allUrns'])->name('allUrns');
Route::delete('/delete-urn/{id}', [UrnController::class, 'destroy'])->name('deleteUrn');


Route::get('/all-services', [ServiceController::class, 'allServices'])->name('allServices');
Route::delete('/delete-service/{id}', [ServiceController::class, 'destroy'])->name('deleteService');

Route::get('/all-serviceList', [ServiceListController::class, 'allServiceList'])->name('allServiceList');

Route::get('/all-serviceList-getPhoto/{id}', [ServiceListController::class, 'getReceipt'])->name('getReceipt');

Route::delete('/delete-serviceList/{id}', [ServiceListController::class, 'destroy'])->name('deleteServiceList');

Route::get('/all-priests', [PriestController::class, 'allPriests'])->name('allPriests');
Route::delete('/delete-priest/{id}', [PriestController::class, 'destroy'])->name('deletePriest');


Route::get('/all-shopcategories', [ShopCategoryController::class, 'allShopCategories'])->name('allShopCategories');
Route::delete('/delete-shopcategory/{id}', [ShopCategoryController::class, 'destroy'])->name('deleteShopCategory');

Route::get('/all-sellers', [SellerController::class, 'allSellers'])->name('allSellers');
Route::delete('/delete-seller/{id}', [SellerController::class, 'destroy'])->name('deleteSeller');

Route::get('/all-products', [ProductController::class, 'allProducts'])->name('allProducts');
Route::delete('/delete-product/{id}', [ProductController::class, 'destroy'])->name('deleteProduct');

Route::get('/all-items', [ShopTransactionController::class, 'allItems'])->name('allItems');
Route::get('/all-memorials', [MemorialTransactionController::class, 'allMemorialsList'])->name('allMemorialsList');
Route::get('/memorial-update/{id}', [MemorialTransactionController::class, 'update'])->name('updateMemorialStatus');
Route::get('/memorial-cancel/{id}', [MemorialTransactionController::class, 'cancel'])->name('cancelMemorialStatus');
//Transaction Table
Route::get('/shop-transaction-list', [ShopTransactionController::class, 'shopTransactionList'])->name('shopTransactionList');
Route::get('/switch-status/{id}', [ShopTransactionController::class, 'switchStatus'])->name('switchStatus');


Route::post('/shop-checkout', [ShopTransactionController::class, 'checkout'])->name('shopCheckout');
Route::post('/service-checkout', [ServicesTransactionController::class, 'checkout'])->name('serviceCheckout');


Route::post('/niches/checkout', [NicheTransactionController::class, 'nicheCheckout'])->name('nicheCheckout');



//Charts
Route::get('/charts/weekly-shop-sales', [ChartController::class, 'weeklyShopSales'])->name('weeklyShopSales');
Route::get('/charts/top-products', [ChartController::class, 'topProduct'])->name('topProduct');

Route::get('/charts/top-service', [ChartController::class, 'topService'])->name('topService');
Route::get('/charts/daily-sales-service', [ChartController::class, 'dailySalesService'])->name('dailySalesService');

Route::get('/charts/niche-status', [ChartController::class, 'nicheStatus'])->name('nicheStatus');
Route::get('/charts/forecasting', [ChartController::class, 'forecasting'])->name('forecasting');

Route::post('/me/transactions/update-urn/{id}', [UsersHistoryController::class, 'updateMyUrn'])->name('updateMyUrn');


