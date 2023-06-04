<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SocmedController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LandingPageController;

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

// Route::get('/', function () {
//     return view('frontend.index');
// });

Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('index');
Route::get('/menu', [App\Http\Controllers\FrontendController::class, 'menu'])->name('menu');
Route::get('/lokasi-store', [App\Http\Controllers\FrontendController::class, 'lokasi'])->name('location');
Route::get('/hubungi-kami', [App\Http\Controllers\FrontendController::class, 'contact'])->name('contact');

Route::get('/pesan', [App\Http\Controllers\HomeController::class, 'order'])->name('items.category');
Route::get('/booking-meeting-room', [App\Http\Controllers\HomeController::class, 'meeting'])->name('meeting');
Route::get('/riwayat-pemesanan', [App\Http\Controllers\HomeController::class, 'history'])->name('history');
Route::delete('/pesan/{name}', [App\Http\Controllers\CartController::class, 'destroy'])->name('order.destroy');
Route::delete('/back/{item}', [App\Http\Controllers\OrderController::class, 'destroy'])->name('back.destroy');
Route::post('/pesan/addtocart', [App\Http\Controllers\CartController::class, 'addToCart'])->name('addtocart');
Route::post('/hubungi-kami', [App\Http\Controllers\ContactController::class, 'contact'])->name('contact');
Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::get('/invoice/{invoice}', [OrderController::class, 'invoice'])->name('invoice');
Route::post('/pay-on-casheer/{order_id}', [App\Http\Controllers\HomeController::class, 'confirm'])->name('confirm');
Route::post('/midtrans_callback', [OrderController::class, 'callback'])->name('callback');

Auth::routes();

Route::middleware('Role:1')->group( function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::resource('/admin/landingpage', LandingPageController::class);
    Route::resource('/admin/menu', ItemController::class);
    Route::resource('/admin/category', CategoriesController::class);
    Route::resource('/admin/location', LocationController::class);
    Route::resource('/admin/socmed', SocmedController::class);
    Route::get('/admin/order', [App\Http\Controllers\HomeController::class, 'activeOrder'])->name('activeOrder');
    Route::get('/admin/message', [App\Http\Controllers\ContactController::class, 'message'])->name('message');
    Route::get('/admin/workers', [App\Http\Controllers\HomeController::class, 'workers'])->name('workers');
    Route::post('/add/workers', [App\Http\Controllers\HomeController::class, 'store'])->name('store');
    Route::match(['put','patch'],'/update/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('update');
    Route::match(['put','patch'],'/cashPayment/{id}', [App\Http\Controllers\OrderController::class, 'cashPayment'])->name('cashPayment');
    Route::match(['put','patch'],'/ePayment/{id}', [App\Http\Controllers\OrderController::class, 'ePayment'])->name('ePayment');
    Route::match(['put','patch'],'/timeline/{id}', [App\Http\Controllers\OrderController::class, 'timeline'])->name('timeline');
    Route::match(['put','patch'],'/timelineKasir/{id}', [App\Http\Controllers\OrderController::class, 'timelineKasir'])->name('timelineKasir');
    Route::delete('/delete/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('destroy');
    Route::get('/draft/{id}', [App\Http\Controllers\ItemController::class, 'draft'])->name('draft');
    Route::get('/publish/{id}', [App\Http\Controllers\ItemController::class, 'publish'])->name('publish');
});
