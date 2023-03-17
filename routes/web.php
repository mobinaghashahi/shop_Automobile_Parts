<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\authController;
use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\Auth\logoutController;
use App\Http\Controllers\Auth\registerController;
use App\Http\Controllers\admin;
use App\Http\Controllers\productDetails;
use App\Http\Middleware\authMiddleware;
use App\Http\Middleware\adminMiddleware;

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

Route::get('/', function () {
    return view('home/home');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});

Route::get('/login', [loginController::class, 'loginView'])->middleware(authMiddleware::class); //روت پست اطلاعات فرم ورود
Route::get('/logout', [logoutController::class, 'logout']); //روت پست اطلاعات فرم ورود


Route::post('/login', [loginController::class, 'login']); //روت پست اطلاعات فرم ورود
Route::post('/register', [registerController::class, 'register']); //روت پست اطلاعات فرم ثبت نام


Route::get('/productDetails', [productDetails::class, 'showDetails']);


Route::prefix('/admin')->middleware(adminMiddleware::class)->group(function () {
    Route::get('/', [admin::class, 'showDashboard']);

    Route::get('/addProduct', [admin::class, 'showAddProduct']);
    Route::post('/addProduct', [admin::class, 'addProduct']);

    Route::get('/addBrand', [admin::class, 'showAddBrand']);
    Route::post('/addBrand', [admin::class, 'addBrand']);

    Route::get('/addCarType', [admin::class, 'showAddCarType']);
    Route::post('/addCarType', [admin::class, 'addCarType']);

    Route::get('/addOff', [admin::class, 'showAddOff']);
    Route::post('/addOff', [admin::class, 'addOff']);

});

