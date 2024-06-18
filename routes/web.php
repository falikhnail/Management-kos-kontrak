<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Category\Index;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Login_controller;
use App\Http\Controllers\XenditController;
use App\Http\Livewire\Kasbank\Createkasbank;
use App\Http\Livewire\Kasbank\Listkasbank;
use App\Http\Livewire\Product\Listproduct;
use App\Http\Livewire\Tagihan\Listtagihan;
use App\Http\Livewire\Penghuni\Listpenghuni;
use App\Http\Livewire\Penghuni\Createpenghuni;
use App\Http\Livewire\Reports\Labarugi;
use App\Http\Livewire\Settings\Generalsettings;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    // return view('layouts.main', [
    //     'title' => 'Blank Page | sangcahaya.id'
    // ]);
    return redirect('home');
});

Route::post('callback-invoice-xendit', [XenditController::class, 'index']);

Route::get('success-invoice/{id}', [XenditController::class, 'successPayment']);

Route::get('artisan-command/{str}', function ($str) {
    $exitCode = Artisan::call($str);
});

Route::get('/login', [Login_controller::class, 'index'])->name('login');
Route::post('/login', [Login_controller::class, 'authenticate']);
Route::get('keluar', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();
    return redirect('login');
});

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index']);

    Route::get('category/index', Index::class);

    Route::get('product/index', Listproduct::class);

    Route::get('penghuni/index', Listpenghuni::class);
    Route::get('penghuni/create/{id?}', Createpenghuni::class);

    Route::get('tagihan/index', Listtagihan::class);

    Route::get('settings/general-settings', Generalsettings::class);

    Route::get('kasbank/index', Listkasbank::class);
    Route::get('kasbank/create/{id?}', Createkasbank::class);

    Route::get('reports/labarugi', Labarugi::class);
});
