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
use App\Http\Controllers\siteMap;
use App\Http\Middleware\authMiddleware;
use App\Http\Middleware\loginMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\CalculatePostPrice;
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

Route::get('/test', [home::class, 'test']);
Route::get('/cities/{id}', [home::class, 'cities']);

Route::get('/contact', [home::class, 'showContact']);
Route::post('/contact', [home::class, 'sendMessage']);

Route::get('/resultSearch',[home::class, 'showResults']);



//نقشه وبسایت
Route::get('/sitemap.xml', function (){
    return "sitemap.xml";
});
Route::get('/sitemap-0.xml', [siteMap::class,'productsSiteMap']);



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


Route::prefix('/admin')->group(function () {
    Route::get('/', [admin::class, 'showDashboard'])->middleware([loginMiddleware::class,'role:admin']);

    Route::post('/sendProduct', [admin::class, 'sendProduct'])->middleware([loginMiddleware::class,'role:admin']);
    Route::get('/undoSendProduct/{id}', [admin::class, 'undoSendProduct'])->middleware([loginMiddleware::class,'role:admin']);
    Route::get('/listOrders/{id}', [admin::class, 'listOrders'])->middleware([loginMiddleware::class,'role:admin']);
    Route::get('/printForSendProduct/{id}', [admin::class, 'printForSendProduct'])->middleware([loginMiddleware::class,'role:admin']);


    Route::get('/addProduct', [admin::class, 'showAddProduct'])->middleware([loginMiddleware::class,'role:admin']);
    Route::post('/addProduct', [admin::class, 'addProduct'])->middleware([loginMiddleware::class,'role:admin']);
    Route::get('/editProductPanel', [admin::class, 'showEditProductPanel'])->middleware([loginMiddleware::class,'role:admin|designer']);
    Route::get('/editProduct/{id}', [admin::class, 'showEditProduct'])->middleware([loginMiddleware::class,'role:admin|designer']);
    Route::post('/editProduct', [admin::class, 'editProduct'])->middleware([loginMiddleware::class,'role:admin|designer']);
    Route::get('/deleteProduct/{id}', [admin::class, 'deleteProduct'])->middleware([loginMiddleware::class,'role:admin']);

    Route::get('/addBrand', [admin::class, 'showAddBrand'])->middleware([loginMiddleware::class,'role:admin']);
    Route::post('/addBrand', [admin::class, 'addBrand'])->middleware([loginMiddleware::class,'role:admin']);
    Route::get('/editBrandPanel', [admin::class, 'showEditBrandPanel'])->middleware([loginMiddleware::class,'role:admin|designer']);
    Route::get('/editBrand/{id}', [admin::class, 'showEditBrand'])->middleware([loginMiddleware::class,'role:admin|designer']);
    Route::post('/editBrand', [admin::class, 'editBrand'])->middleware([loginMiddleware::class,'role:admin|designer']);
    Route::get('/deleteBrand/{id}', [admin::class, 'deleteBrand'])->middleware([loginMiddleware::class,'role:admin']);

    Route::get('/addCarType', [admin::class, 'showAddCarType'])->middleware([loginMiddleware::class,'role:admin']);
    Route::post('/addCarType', [admin::class, 'addCarType'])->middleware([loginMiddleware::class,'role:admin']);
    Route::get('/editCarTypePanel', [admin::class, 'showEditCarTypePanel'])->middleware([loginMiddleware::class,'role:admin']);
    Route::get('/deleteCarType/{id}', [admin::class, 'deleteCarType'])->middleware([loginMiddleware::class,'role:admin']);
    Route::get('/editCarType/{id}', [admin::class, 'showEditCarType'])->middleware([loginMiddleware::class,'role:admin']);
    Route::post('/editCarType', [admin::class, 'editCarType'])->middleware([loginMiddleware::class,'role:admin']);

    Route::get('/addOff', [admin::class, 'showAddOff'])->middleware([loginMiddleware::class,'role:admin']);
    Route::post('/addOff', [admin::class, 'addOff'])->middleware([loginMiddleware::class,'role:admin']);
    Route::get('/editOffPanel', [admin::class, 'showEditOffPanel'])->middleware([loginMiddleware::class,'role:admin']);
    Route::get('/deleteOff/{id}', [admin::class, 'deleteOff'])->middleware([loginMiddleware::class,'role:admin']);
    Route::get('/editOff/{id}', [admin::class, 'showEditOff'])->middleware([loginMiddleware::class,'role:admin']);
    Route::post('/editOff', [admin::class, 'editOff'])->middleware([loginMiddleware::class,'role:admin']);

    Route::get('/addCategory', [admin::class, 'showAddCategory'])->middleware([loginMiddleware::class,'role:admin']);
    Route::post('/addCategory', [admin::class, 'addCategory'])->middleware([loginMiddleware::class,'role:admin']);
    Route::get('/editCategoryPanel', [admin::class, 'showEditCategoryPanel'])->middleware([loginMiddleware::class,'role:admin|designer']);
    Route::get('/deleteCategory/{id}', [admin::class, 'deleteCategory'])->middleware([loginMiddleware::class,'role:admin']);
    Route::get('/editCategory/{id}', [admin::class, 'showEditCategory'])->middleware([loginMiddleware::class,'role:admin|designer']);
    Route::post('/editCategory', [admin::class, 'editCategory'])->middleware([loginMiddleware::class,'role:admin|designer']);

    Route::get('/showMessages', [admin::class, 'showMessages'])->middleware([loginMiddleware::class,'role:admin']);
    Route::get('/seenMessage/{id}', [admin::class, 'seenMessage'])->middleware([loginMiddleware::class,'role:admin']);

    Route::get('/addSlideShow', [admin::class, 'showAddSlideShow'])->middleware([loginMiddleware::class,'role:admin']);
    Route::post('/addSlideShow', [admin::class, 'addSlideShow'])->middleware([loginMiddleware::class,'role:admin']);
    Route::get('/deleteSlideShow/{id}', [admin::class, 'deleteSlideShow'])->middleware([loginMiddleware::class,'role:admin']);
    Route::get('/editSlideShowPanel', [admin::class, 'showEditSlideShowPanel'])->middleware([loginMiddleware::class,'role:admin']);
    Route::get('/editSlideShow/{id}', [admin::class, 'showEditSlideShow'])->middleware([loginMiddleware::class,'role:admin']);
    Route::post('/editSlideShow', [admin::class, 'editSlideShow'])->middleware([loginMiddleware::class,'role:admin']);

    Route::get('/editAllProductPrice', [admin::class, 'editAllProductPricePanel'])->middleware([loginMiddleware::class,'role:admin']);
    Route::post('/editAllProductPrice', [admin::class, 'editAllProductPrice'])->middleware([loginMiddleware::class,'role:admin']);

    Route::get('/listCarTypeForJquary/{id}',[admin::class,'listCarTypeForJquary'])->middleware([loginMiddleware::class,'role:admin']);

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

    Route::get('/addUserInformation',[cart::class,'addUserInformation'])->middleware(UserMiddleware::class);
    Route::get('/finalApproval',[cart::class,'finalApproval'])->middleware(UserMiddleware::class)->middleware(CalculatePostPrice::class);
});

Route::prefix('/payment')->middleware(UserMiddleware::class)->group(function () {
   Route::post('/pay',[payment::class,'pay'])->middleware(CalculatePostPrice::class);
   Route::get('/verify',[payment::class,'verify']);
});


