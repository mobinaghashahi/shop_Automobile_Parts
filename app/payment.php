<?php

use Illuminate\Support\Facades\Auth;

function responseCodeChecker($response)
{
    //اگر پول پرداختی با پول ارجاع داده شده مقایرت داشته باشد
    if (json_decode($response)->data->code == -50) {
        //ارسال پیامک هشدار
        sendAlertOrderSms(Auth::user()->nameAndFamily,json_decode($response)->data->ref_id);
        return "differentCost";
    } else if (json_decode($response)->data->code == 100 || json_decode($response)->data->code == 101) {
        //ارسال پیامک خرید موفق
        sendNewOrderSms(Auth::user()->nameAndFamily,session('amount'));
        return "ok";
    } else {
        return "noOk";
    }

}


function verify()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.zarinpal.com/pg/v4/payment/verify.json',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
  "merchant_id": "91553fab-dac6-4b9f-85b4-2813c98e5bad",
  "amount": "' . session('amount') . '",
  "authority": "' . session('authority') . '"
}',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Accept: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
