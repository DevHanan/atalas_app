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

});

