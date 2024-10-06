<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
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
use App\Http\Controllers\MemorialController;
use App\Http\Controllers\MemorialTransactionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
//Authentication
Route::middleware(['guest'])->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'postLogin'])->name('postlogin');
    Route::get('register', [LoginController::class, 'register'])->name('register');
    Route::post('register', [LoginController::class, 'postRegister'])->name('postregister');
    Route::get('forgot-password', [LoginController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('forgot-password', [LoginController::class, 'checkEmail'])->name('checkEmail');
    Route::get('send_link', [LoginController::class, 'send_link'])->name('send_link');
    Route::get('reset_password/{id}', [LoginController::class, 'reset_password'])->name('reset_password');
    Route::post('reset_password/{id}', [LoginController::class, 'change_password'])->name('change_password');
    Route::get('verified/{id}', [LoginController::class, 'verified'])->name('verified');
});
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('x', [LoginController::class, 'x'])->name('x');
//Users
Route::group(['middleware' => 'role:admin,Admin', 'auth'], function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('users');
    //Admin ----> Niches---->Buildings
    Route::get('/admin/niches/building', [BuildingController::class, 'index'])->name('buildings');
    Route::get('/admin/niches/building-create', [BuildingController::class, 'create'])->name('createBuilding');
    Route::post('/admin/niches/building-postcreate', [BuildingController::class, 'store'])->name('postCreateBuilding');
    Route::get('/admin/niches/building-edit/{id}', [BuildingController::class, 'edit'])->name('editBuilding');
    Route::post('/admin/niches/building-update/{id}', [BuildingController::class, 'update'])->name('updateBuilding');


    //Admin ----> Niches----> Niches
    Route::get('/admin/niches/index', [NicheController::class, 'index'])->name('niches');
    Route::get('/admin/niches/niche-create', [NicheController::class, 'create'])->name('createNiche');
    Route::post('/admin/niches/niche-postcreate', [NicheController::class, 'store'])->name('postCreateNiche');
    Route::get('/admin/niches/niche-edit/{id}', [NicheController::class, 'edit'])->name('editNiche');
    Route::post('/admin/niches/niche-update/{id}', [NicheController::class, 'update'])->name('updateNiche');
    Route::get('/admin/transactions/adminNiches', [NicheController::class, 'adminNiches'])->name('adminNiches');

    //Admin ----> Niches----> Urns
    Route::get('/admin/niches/urns', [UrnController::class, 'index'])->name('urns');
    Route::get('/admin/niches/urn-create', [UrnController::class, 'create'])->name('createUrn');
    Route::post('/admin/niches/urn-postcreate', [UrnController::class, 'store'])->name('postCreateUrn');
    Route::get('/admin/niches/urn-edit/{id}', [UrnController::class, 'edit'])->name('editUrn');
    Route::post('/admin/niches/urn-update/{id}', [UrnController::class, 'update'])->name('updateUrn');







    //Admin ----> Service----> Category
    Route::get('/admin/services/category', [ServiceController::class, 'index'])->name('services');
    Route::get('/admin/services/category-create', [ServiceController::class, 'create'])->name('createService');
    Route::post('/admin/services/category-postcreate', [ServiceController::class, 'store'])->name('postCreateService');
    Route::get('/admin/services/category-edit/{id}', [ServiceController::class, 'edit'])->name('editService');
    Route::post('/admin/services/category-update/{id}', [ServiceController::class, 'update'])->name('updateService');


    //Admin ----> Service----> ServiceList
    Route::get('/admin/services/serviceList', [ServiceListController::class, 'index'])->name('serviceList');
    Route::get('/admin/services/servicelist-create', [ServiceListController::class, 'create'])->name('createServiceList');
    Route::post('/admin/services/servicelist-postcreate', [ServiceListController::class, 'store'])->name('postCreateServiceList');
    Route::get('/admin/services/servicelist-edit/{id}', [ServiceListController::class, 'edit'])->name('editServiceList');
    Route::post('/admin/services/servicelist-update/{id}', [ServiceListController::class, 'update'])->name('updateServiceList');


    //Admin ----> Service----> Priest
    Route::get('/admin/services/priests', [PriestController::class, 'index'])->name('priests');
    Route::get('/admin/services/priest-create', [PriestController::class, 'create'])->name('createPriest');
    Route::post('/admin/services/priest-postcreate', [PriestController::class, 'store'])->name('postCreatePriest');
    Route::get('/admin/services/priest-edit/{id}', [PriestController::class, 'edit'])->name('editPriest');
    Route::post('/admin/services/priest-update/{id}', [PriestController::class, 'update'])->name('updatePriest');


    //Admin ----> Shop----> Categories
    Route::get('/admin/shop/categories', [ShopCategoryController::class, 'index'])->name('shopCategories');
    Route::get('/admin/shop/category-create', [ShopCategoryController::class, 'create'])->name('createShopCategory');
    Route::post('/admin/shop/category-postcreate', [ShopCategoryController::class, 'store'])->name('postCreateShopCategory');
    Route::get('/admin/shop/category-edit/{id}', [ShopCategoryController::class, 'edit'])->name('editShopCategory');
    Route::post('/admin/shop/category-update/{id}', [ShopCategoryController::class, 'update'])->name('updateShopCategory');


    //Admin ----> Shop----> Sellers
    Route::get('/admin/shop/sellers', [SellerController::class, 'index'])->name('sellers');
    Route::get('/admin/shop/seller-create', [SellerController::class, 'create'])->name('createSeller');
    Route::post('/admin/shop/seller-postcreate', [SellerController::class, 'store'])->name('postCreateSeller');
    Route::get('/admin/shop/seller-edit/{id}', [SellerController::class, 'edit'])->name('editSeller');
    Route::post('/admin/shop/seller-update/{id}', [SellerController::class, 'update'])->name('updateSeller');


    //Admin ----> Shop----> Products
    Route::get('/admin/shop/products', [ProductController::class, 'index'])->name('products');
    Route::get('/admin/shop/product-create', [ProductController::class, 'create'])->name('createProduct');
    Route::post('/admin/shop/product-postcreate', [ProductController::class, 'store'])->name('postCreateProduct');
    Route::get('/admin/shop/product-edit/{id}', [ProductController::class, 'edit'])->name('editProduct');
    Route::post('/admin/shop/product-update/{id}', [ProductController::class, 'update'])->name('updateProduct');
    Route::post('/admin/shop/transaction', [ProductController::class, 'transaction'])->name('shopTransaction');

    //Admin ----> Shop----> Transaction

    Route::get('/admin/shop/transactions', [ShopTransactionController::class, 'shopTransactionView'])->name('shopTransactionView');

    //charts
    Route::get('/admin/shop/sales', [ChartController::class, 'shopSales'])->name('shopSales');
    Route::get('/admin/services/sales', [ChartController::class, 'serviceSales'])->name('serviceSales');
    Route::get('/admin/niches/sales', [ChartController::class, 'nichesSales'])->name('nichesSales');

    // Admin setting
    Route::get('/admin/setting', [LoginController::class, 'adminsSetting'])->name('adminSetting');
    Route::post('/admin/setting', [LoginController::class, 'adminSettingUpdate'])->name('adminSettingUpdate');
    Route::post('/admin/updatePassword', [LoginController::class, 'adminSettingUpdatePassword'])->name('adminSettingUpdatePassword');

    //Admin Memorial Trans
    Route::get('/admin/services/memorial', [MemorialTransactionController::class, 'index'])->name('memorial');
    // Route::get('/admin/services/memorial-edit/{id}', [MemorialTransactionController::class, 'edit'])->name('memorialEdit');
    

});

//Shop Transaction
Route::get('/shop/products', [ShopTransactionController::class, 'index'])->name('tranShop');
//Services Transaction
Route::get('/services', [ServicesTransactionController::class, 'index'])->name('tranService');
Route::get('/services/{id}/payment-page', [ServicesTransactionController::class, 'payment'])->name('servicePayment')->middleware('auth');
Route::post('/services/{id}/payment-page', [ServicesTransactionController::class, 'postPayment'])->name('servicePostPayment')->middleware('auth');
Route::get('/service/success', [ServicesTransactionController::class, 'success'])->name('serviceSuccess')->middleware('auth');
//Niches Transaction
Route::get('/niches', [NicheTransactionController::class, 'index'])->name('tranNiche');
Route::get('/niches/building/{id}', [NicheTransactionController::class, 'building'])->name('buildingNo');
Route::get('/niches/niche/{id}', [NicheTransactionController::class, 'niche'])->name('nicheNo')->middleware('auth');
Route::get('/niches/niche/{id}/view', [NicheTransactionController::class, 'nicheView'])->name('nicheView');
Route::get('/niches/niche/{id}/update', [NicheTransactionController::class, 'nicheUpdate'])->name('nicheUpdate')->middleware('auth');
Route::post('/niches/niche/{id}/update', [NicheTransactionController::class, 'postNicheUpdate'])->name('postNicheUpdate')->middleware('auth');
Route::get('/niches/service-view', [NicheTransactionController::class, 'serviceView'])->name('serviceView')->middleware('auth');
Route::get('/niches/success', [NicheTransactionController::class, 'success'])->name('success')->middleware('auth');
// User setting
Route::get('/setting', [LoginController::class, 'setting'])->name('userSetting')->middleware('auth');
Route::post('/setting', [LoginController::class, 'settingUpdate'])->name('userSettingUpdate')->middleware('auth');
Route::post('/updatePassword', [LoginController::class, 'settingUpdatePassword'])->name('userSettingUpdatePassword')->middleware('auth');




//Client Transaction
Route::get('/me/transactions/myRequests', [ServiceListController::class, 'myRequests'])->name('myRequests')->middleware('auth');
Route::get('/me/transactions/myRequestList', [ServiceListController::class, 'allRequests'])->name('allRequests');
Route::get('/me/transactions/myPurchases', [ShopTransactionController::class, 'shopTransactionListUser'])->name('shopTransactionListUser');
Route::get('/me/transactions/myNiches', [UsersHistoryController::class, 'myNiches'])->name('myNiches');

Route::get('/me/transactions/myMemorials', [MemorialController::class, 'myMemorials'])->name('myMemorials');
Route::get('/me/transactions/myMemorials/{id}/cancel', [MemorialController::class, 'cancelPurchasesMemorial'])->name('cancelPurchasesMemorial');

Route::get('/me/transactions/myUrns', [UsersHistoryController::class, 'myUrns'])->name('myUrns');
Route::get('/me/transactions/edit-urn/{id}', [UsersHistoryController::class, 'editMyUrn'])->name('editMyUrn');
Route::get('/me/transactions/myRequests/{id}/cancel',[ServiceListController::class,'cancelService'])->name('cancelMyRequests')->middleware('auth');
Route::get('/me/transactions/myPurchases/{id}/cancel',[ShopTransactionController::class,'cancelPurchases'])->name('cancelmyPurchases')->middleware('auth');
Route::get('/me/transactions/myNiches/{id}/cancel',[UsersHistoryController::class,'cancelservicePostPaymentNiche'])->name('cancelmyUrns')->middleware('auth');


Route::get('/memorials', [MemorialController::class, 'index'])->name('memorials');
Route::get('/memorial-create', [MemorialController::class, 'create'])->name('createMemorial')->middleware('auth');
Route::post('/post-create-memorial', [MemorialController::class, 'store'])->name('storeMemorial')->middleware('auth');
Route::get('/memorial/view/{id}', [MemorialController::class, 'memorialView'])->name('memorialView');


Route::get('/admin/forecast', [UserController::class,'forecast'])->name('forecast')->middleware('role:admin,Admin', 'auth');
Route::get('/admin/forecast/building/{id}', [UserController::class,'forecastBuilding'])->name('forecastBuilding')->middleware('role:admin,Admin', 'auth');
Route::get('/admin/forecast/niche/{id}', [UserController::class,'forecastNiche'])->name('forecastNiche')->middleware('role:admin,Admin', 'auth');
Route::get('/admin/forecast/sale', [UserController::class,'forecastSale'])->name('forecastSale')->middleware('role:admin,Admin', 'auth');
Route::get('/admin/forecast/services/sales', [UserController::class,'forecastServicesSales'])->name('forecastServicesSales')->middleware('role:admin,Admin', 'auth');
Route::get('/admin/forecast/shop/sales', [UserController::class,'forecastShopSales'])->name('forecastShopSales')->middleware('role:admin,Admin', 'auth');
Route::get('/about-us', function () {
    return view('clientview.aboutus');
})->name('aboutUs');

Route::get('/home', function () {
    return view('clientview.home');
})->name('home');

Route::get('/', function () {
    return redirect('home');
});
