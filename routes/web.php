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
use App\Http\Controllers\cart;
use App\Http\Controllers\payment;
use App\Http\Controllers\Auth\forgetPassword;
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
Route::get('/aboutUs', [home::class, 'aboutUs']);

Route::get('/contact', [home::class, 'showContact']);
Route::post('/contact', [home::class, 'sendMessage']);

Route::get('/resultSearch',[home::class, 'showResults']);

//نقشه وبسایت
Route::get('/sitemap.xml', function (){
    return "sitemap.xml";
});

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
Route::get('/forgetPassword', [forgetPassword::class, 'forgetPasswordShow'])->middleware(authMiddleware::class);
Route::post('/forgetPasswordSendSms', [forgetPassword::class, 'forgetPasswordSendSms'])->middleware(authMiddleware::class);
Route::get('/enterForgetPasswordCode/{id}', [forgetPassword::class, 'showEnterForgetPasswordCode'])->middleware(authMiddleware::class);
Route::post('/enterForgetPasswordCode', [forgetPassword::class, 'enterForgetPasswordCode'])->middleware(authMiddleware::class);

Route::get('/changeForgetPassword', [forgetPassword::class, 'changeForgetPassword'])->middleware(authMiddleware::class);
Route::post('/changeForgetPassword', [forgetPassword::class, 'validateChangeForgetPassword'])->middleware(authMiddleware::class);


Route::get('/productDetails/{id}', [products::class, 'showDetails']);


Route::prefix('/admin')->middleware(adminMiddleware::class)->group(function () {
    Route::get('/', [admin::class, 'showDashboard']);

    Route::post('/sendProduct', [admin::class, 'sendProduct']);
    Route::get('/undoSendProduct/{id}', [admin::class, 'undoSendProduct']);
    Route::get('/listOrders/{id}', [admin::class, 'listOrders']);
    Route::get('/printForSendProduct/{id}', [admin::class, 'printForSendProduct']);


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

    Route::get('/showMessages', [admin::class, 'showMessages']);
    Route::get('/seenMessage/{id}', [admin::class, 'seenMessage']);

    Route::get('/addSlideShow', [admin::class, 'showAddSlideShow']);
    Route::post('/addSlideShow', [admin::class, 'addSlideShow']);
    Route::get('/deleteSlideShow/{id}', [admin::class, 'deleteSlideShow']);
    Route::get('/editSlideShowPanel', [admin::class, 'showEditSlideShowPanel']);
    Route::get('/editSlideShow/{id}', [admin::class, 'showEditSlideShow']);
    Route::post('/editSlideShow', [admin::class, 'editSlideShow']);

    Route::get('/editAllProductPrice', [admin::class, 'editAllProductPricePanel']);
    Route::post('/editAllProductPrice', [admin::class, 'editAllProductPrice']);

    Route::get('/listCarTypeForJquary/{id}',[admin::class,'listCarTypeForJquary']);

});

Route::prefix('/user')->middleware(UserMiddleware::class)->group(function () {
    Route::get('/dashboard', [users::class, 'showDashboard']);
    Route::get('/profile', [users::class, 'showProfile']);
    Route::post('/profile', [users::class, 'editProfile']);
    Route::get('/orders', [users::class, 'showOrders']);
    Route::get('/orderDetails/{id}', [users::class, 'showOrderDetails'])->middleware(cartValidForUserMiddleware::class);
});

Route::prefix('/cart')->group(function () {
    Route::post('/addToCart',[cart::class,'addToCart']);

    Route::post('/decreaseCount',[cart::class,'decreaseCount']);
    Route::post('/increaseCount',[cart::class,'increaseCount']);

    Route::get('/showCart',[cart::class,'showCart']);
    Route::get('/deleteOfCart/{id}',[cart::class,'deleteOfCart']);
});

Route::prefix('/payment')->middleware(UserMiddleware::class)->group(function () {
   Route::post('/pay',[payment::class,'pay']);
   Route::get('/verify',[payment::class,'verify']);
});


