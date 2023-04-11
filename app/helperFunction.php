<?php

use App\Models\Buy;
use App\Models\Product;
use App\Models\Visit;
use Hekmatinasser\Verta\Verta;


function calSumPrice($id)
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

function callCountSellProducts($id)
{
    $count=0;
    $sells = Buy::where('products_id', '=', $id)->get();
    foreach ($sells as $sell){
        $count+=$sell->count;
    }
    return $count;
}

function stock($id){
    $product=Product::where('id','=',$id)->get()[0];
    return $product->count-callCountSellProducts($id);
}

function countCart(){
    return count(session('products'));
}
function sendSmsToAdmin($name,$price){

    $client = new SoapClient("http://188.0.240.110/class/sms/wsdlservice/server.php?wsdl");
    $user = "09139638917";
    $pass = "faraz1180076915";
    $fromNum = "+3000505";
    $toNum = array("09139638917");
    $pattern_code = "de2bsqxz3oz1cuv";
    $input_data = array(
        "name" => $name,
        "price" => $price
    );
    echo $client->sendPatternSms($fromNum, $toNum, $user, $pass, $pattern_code, $input_data);
}

function visitedMonthAgo(){
    //this is for fix groupBy error!!!!!
    \DB::statement("SET SQL_MODE=''");
    $countVisit = array();
    $v = Verta::now();
    $visitQuary = Visit::where('date', 'like', '%' . $v->format('Y-m-d') . '%')->groupBy('ip')->get()->count();
    array_push($countVisit,array($v->format('Y-m-d'),$visitQuary));
    for ($i = 1; $i <= 30; $i++) {
        $date=$v->subDay(1)->format('Y-m-d');
        $visitQuary = Visit::where('date', 'like', '%' . $date . '%')->groupBy('ip')->get()->count();
        array_push($countVisit,array($date,$visitQuary));
    }
    return $countVisit;
}

function webBrowsersVisit(){
    //this is for fix groupBy error!!!!!
    \DB::statement("SET SQL_MODE=''");
    $webbrowsers=Visit::select('webbrowser')->where('webbrowser','!=',null)->groupBy('webbrowser')->get();
    $chartValues=array();
    $countAllWebBrowsersVisit=0;
    foreach ($webbrowsers as $webbrowser) {
        if ($webbrowser->webbrowser==null)
            continue;
        $count= Visit::where('webbrowser','=',$webbrowser->webbrowser)->groupBy('ip')->get()->count().' ';
        $countAllWebBrowsersVisit+=$count;
        array_push($chartValues,array($webbrowser->webbrowser,$count));
    }

    $countAllWebBrowsers=$webbrowsers->count();
    //به دست آوردن کل بازدید های انجام شده با مرورگر های مختلف برای درصد گیری.
    foreach ($chartValues as $key => $val){
        $chartValues[$key][1]=($chartValues[$key][1]/$countAllWebBrowsersVisit)*100;
    }
    return $chartValues;
}
