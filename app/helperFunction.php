<?php

use App\Models\Buy;
use App\Models\Product;
use App\Models\Visit;
use App\Models\Contact;
use App\Models\User;
use App\Models\Off;
use App\Models\Cities;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;


function calSumPrice($id): float|int
{
    $sum = 0;

    $buys = Buy::join('products', 'products.id', '=', 'buy.products_id')
        ->where('cart_id', '=', $id)
        ->select('buy.count as count', 'buy.price as price')
        ->get();

    foreach ($buys as $buy) {
        $sum += $buy->price * $buy->count;
    }
    return $sum;
}

function callCountSellProducts($id): int
{
    $count = 0;
    $sells = Buy::where('products_id', '=', $id)->get();
    foreach ($sells as $sell) {
        $count += $sell->count;
    }
    return $count;
}

function stock($id): int
{
    $product = Product::where('id', '=', $id)->get()[0];
    //موجودی را از تعداد کالاهای فروش رفته کم میکنیم
    return $product->count - callCountSellProducts($id);
}

//a function for check availability
function isInStock($id): bool
{
    $products=Product::find($id);
    if($products->availability=="instock"&&stock($id)>0)
        return true;
    return false;
}

function countCart(): int
{
    return count(session('products'));
}


function visitedMonthAgo(): array
{
    //this is for fix groupBy error!!!!!
    \DB::statement("SET SQL_MODE=''");

    $countVisit = array();
    $v = Verta::now();
    $visitQuary = Visit::where('date', 'like', '%' . $v->format('Y-m-d') . '%')->groupBy('ip')->get()->count();
    array_push($countVisit, array($v->format('Y-m-d'), $visitQuary));
    for ($i = 1; $i <= 30; $i++) {
        $date = $v->subDay(1)->format('Y-m-d');
        $visitQuary = Visit::where('date', 'like', '%' . $date . '%')->groupBy('ip')->get()->count();
        array_push($countVisit, array($date, $visitQuary));
    }
    return $countVisit;
}

function webBrowsersVisit()
{
    //this is for fix groupBy error!!!!!
    \DB::statement("SET SQL_MODE=''");
    $webbrowsers = Visit::select('webbrowser')->where('webbrowser', '!=', null)->groupBy('webbrowser')->get();
    $chartValues = array();
    $countAllWebBrowsersVisit = 0;
    foreach ($webbrowsers as $webbrowser) {
        if ($webbrowser->webbrowser == null)
            continue;
        $count = Visit::where('webbrowser', '=', $webbrowser->webbrowser)->groupBy('ip')->get()->count() . ' ';
        $countAllWebBrowsersVisit += $count;
        array_push($chartValues, array($webbrowser->webbrowser, $count));
    }

    $countAllWebBrowsers = $webbrowsers->count();
    //به دست آوردن کل بازدید های انجام شده با مرورگر های مختلف برای درصد گیری.
    foreach ($chartValues as $key => $val) {
        $chartValues[$key][1] = ($chartValues[$key][1] / $countAllWebBrowsersVisit) * 100;
    }
    return $chartValues;
}

function generateCode(): int
{
    return rand(1000, 9999);
}

function diffrentMin($date): int
{

//جدا کردن ساخت و تاریخ
    $time = explode(' ', $date)[1];
    $dateNow = Verta::now();
    return $dateNow->diffMinutes($time);
}

function countNewMessages()
{
    return Contact::where('state', '=', '0')->get()->count();
}

function totalPriceCart(): float|int
{
    $totalPrice = 0;
    //$sendPrice = postPrice();
    foreach (session('products') as $key => $value) {
        $result = Product::where('id', '=', $key)->get();
        $totalPrice += $result[0]->price * $value;
    }
    return $totalPrice;
}

function postPrice(): int
{
    $userLocation = User::join('city', 'city.id', '=', 'users.city_id')
        ->join('province_cities', 'province_cities.id', '=', 'city.province_id')
        ->where('users.id', '=', Auth::user()->id)
        ->select('province_cities.name as provinceCity')
        ->get();
    //ارسال برای تهران رایگان است
    if ($userLocation[0]->provinceCity == 'تهران')
        return 0;
    //ارسال به سراسر ایران 200 هزارتومان است
    return 200000;
}
function offPercentByBrandID($brand_id){
    $offPercent=Off::select('percent')->where('brand_id','=',$brand_id)->get();
    return $offPercent[0]->percent;
}
function offCalculation($offPercent,$price){
    return ($price*(100-$offPercent))/100;
}
