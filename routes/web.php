<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\VisitController;
use App\Http\Controllers\Admin\OrderController;

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

Route::get('/',function(){
return redirect('admin/login');
});
Route::middleware(['XSS'])->prefix('admin')->group(function () {
    Auth::routes(['register' => false]);
});

Route::middleware(['auth:web', 'XSS'])->name('admin.')->prefix('admin')->group(function () {

    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard.index');
    Route::resource('pages',PageController::class);
    Route::resource('sections',SectionController::class);
    Route::resource('categories',CategoryController::class);
    Route::resource('sliders',SliderController::class);


     // Setting Routes
     Route::get('setting', [SettingController::class,'index'])->name('setting.index');
     Route::post('setting/siteinfo', [SettingController::class ,'siteInfo'])->name('setting.siteinfo');

    // Profile Routes
    Route::resource('profile',ProfileController::class);
    Route::get('profile/account', [ProfileController::class,'account'])->name('profile.account');
    Route::post('profile/changemail', [ProfileController::class,'changeMail'])->name('profile.changemail');
    Route::post('profile/changepass', [ProfileController::class,'changePass'])->name('profile.changepass');


    Route::resource('province',ProvinceController::class);
    Route::resource('district',DistrictController::class);

    Route::resource('companies',CompanyController::class);
    Route::resource('products',ProductController::class);
    Route::resource('sales',SaleController::class);
    Route::get('sales-status/{id}', [SaleController::class,'status'])->name('sales.status');
    Route::post('sales-password-change', [SaleController::class ,'passwordChange'])->name('sales-password-change');

    Route::resource('delivery',DeliveryController::class);
    Route::get('delivery-status/{id}', [DeliveryController::class,'status'])->name('delivery.status');
    Route::post('delivery-password-change', [DeliveryController::class ,'passwordChange'])->name('delivery-password-change');
   
    Route::post('filter-section', [FilterController::class ,'filterSection'])->name('filter-section');
    Route::post('filter-district', [FilterController::class ,'filterDistrict'])->name('filter-district');


    Route::resource('clients',ClientController::class);
    Route::get('clients-status/{id}', [ClientController::class,'status'])->name('clients.status');
    Route::post('clients-password-change', [ClientController::class ,'passwordChange'])->name('client-password-change');
   


    Route::resource('visits',VisitController::class);
    Route::get('visits-status/{id}', [VisitController::class,'status'])->name('visits.status');

    Route::resource('orders',OrderController::class);
    Route::get('orders-status/{id}', [OrderController::class,'status'])->name('orders.status');



});

