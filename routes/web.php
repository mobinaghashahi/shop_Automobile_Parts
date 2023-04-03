<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\authController;
use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\Auth\logoutController;
use App\Http\Controllers\Auth\registerController;
use App\Http\Controllers\admin;
use App\Http\Controllers\home;
use App\Http\Controllers\users;
use App\Http\Controllers\productBrand;
use App\Http\Controllers\products;
use App\Http\Controllers\productDetails;
use App\Http\Middleware\authMiddleware;
use App\Http\Middleware\adminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\cartValidForUserMiddleware;

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

Route::get('/', [home::class, 'showHome']);
Route::get('/brands/{id}', [products::class, 'showProductsByBrand']);
Route::get('/carTypeCategorys/{id}', [products::class, 'showProductsByCarTypeCategorys']);
Route::get('/carTypeProducts/{carType_id}/{category_id}', [products::class, 'showCarTypeProducts']);

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


Route::get('/productDetails/{id}', [products::class, 'showDetails']);


Route::prefix('/admin')->middleware(adminMiddleware::class)->group(function () {
    Route::get('/', [admin::class, 'showDashboard']);

    Route::get('/addProduct', [admin::class, 'showAddProduct']);
    Route::post('/addProduct', [admin::class, 'addProduct']);
    Route::get('/editProductPanel', [admin::class, 'showEditProductPanel']);
    Route::get('/editProduct/{id}', [admin::class, 'showEditProduct']);
    Route::post('/editProduct', [admin::class, 'editProduct']);
    Route::get('/deleteProduct/{id}', [admin::class, 'deleteProduct']);

    Route::get('/addBrand', [admin::class, 'showAddBrand']);
    Route::post('/addBrand', [admin::class, 'addBrand']);
    Route::get('/editBrandPanel', [admin::class, 'showEditBrandPanel']);
    Route::get('/editBrand/{id}', [admin::class, 'showEditBrand']);
    Route::post('/editBrand', [admin::class, 'editBrand']);
    Route::get('/deleteBrand/{id}', [admin::class, 'deleteBrand']);

    Route::get('/addCarType', [admin::class, 'showAddCarType']);
    Route::post('/addCarType', [admin::class, 'addCarType']);
    Route::get('/editCarTypePanel', [admin::class, 'showEditCarTypePanel']);
    Route::get('/deleteCarType/{id}', [admin::class, 'deleteCarType']);
    Route::get('/editCarType/{id}', [admin::class, 'showEditCarType']);
    Route::post('/editCarType', [admin::class, 'editCarType']);

    Route::get('/addOff', [admin::class, 'showAddOff']);
    Route::post('/addOff', [admin::class, 'addOff']);
    Route::get('/editOffPanel', [admin::class, 'showEditOffPanel']);
    Route::get('/deleteOff/{id}', [admin::class, 'deleteOff']);
    Route::get('/editOff/{id}', [admin::class, 'showEditOff']);
    Route::post('/editOff', [admin::class, 'editOff']);

    Route::get('/addCategory', [admin::class, 'showAddCategory']);
    Route::post('/addCategory', [admin::class, 'addCategory']);
    Route::get('/editCategoryPanel', [admin::class, 'showEditCategoryPanel']);
    Route::get('/deleteCategory/{id}', [admin::class, 'deleteCategory']);
    Route::get('/editCategory/{id}', [admin::class, 'showEditCategory']);
    Route::post('/editCategory', [admin::class, 'editCategory']);

});

Route::prefix('/user')->middleware(UserMiddleware::class)->group(function () {
    Route::get('/dashboard', [users::class, 'showDashboard']);
    Route::get('/profile', [users::class, 'showProfile']);
    Route::post('/profile', [users::class, 'editProfile']);
    Route::get('/orders', [users::class, 'showOrders']);
    Route::get('/orderDetails/{id}', [users::class, 'showOrderDetails'])->middleware(cartValidForUserMiddleware::class);
});
