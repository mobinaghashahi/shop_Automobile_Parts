<?php

//سیستم پیام فراز اس ام اس تغییر کرد و من ورژن دو پیامک رو گذاشتم براش
function sendSmsForgetPassword($phoneNumber, $code)
{

    $client = new SoapClient("http://188.0.240.110/class/sms/wsdlservice/server.php?wsdl");
    $user = env("SMS_USERNAME");
    $pass = env("SMS_PASSWORD");
    $fromNum = "+3000505";
    $toNum = array($phoneNumber);
    $pattern_code = "a0j80azuywnn4vy";
    $input_data = array(
        "code" => $code,
    );
    echo $client->sendPatternSms($fromNum, $toNum, $user, $pass, $pattern_code, $input_data);
}

function sendSmsForgetPassword_V2($phoneNumber, $code)
{
    $curl = curl_init();

    $data = [
        "code" => "a0j80azuywnn4vy", // کد Pattern
        "attributes" => [
            "code" => $code,
            // اگر Pattern فقط یک متغیر دارد، همین کافی است
        ],
        "recipient" => $phoneNumber,
        "line_number" => "50002178584000",
        "number_format" => "english"
    ];

    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://api.iranpayamak.com/ws/v1/sms/pattern',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => [
            'Accept: application/json',
            'Api-Key: ' . env('SMS_API_KEY'),,
            'Content-Type: application/json',
        ],
    ]);

    $response = curl_exec($curl);

    if ($response === false) {
        $error = curl_error($curl);
        curl_close($curl);

        throw new Exception("SMS API Error: " . $error);
    }

    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);

    return [
        'status' => $httpCode,
        'response' => json_decode($response, true),
    ];
}

function sendNewOrderSms($name, $price,$number)
{

    $client = new SoapClient("http://188.0.240.110/class/sms/wsdlservice/server.php?wsdl");
    $user = env("SMS_USERNAME");
    $pass = env("SMS_PASSWORD");
    $fromNum = "+3000505";
    $toNum = array($number);
    $pattern_code = "de2bsqxz3oz1cuv";
    $input_data = array(
        "name" => $name,
        "price" => $price
    );
    echo $client->sendPatternSms($fromNum, $toNum, $user, $pass, $pattern_code, $input_data);
}
//کرل اس ام اس فراز اس ام اس تغییر کرد و من به این صورت تغییرش دادم به عنوان ورژن دو
function sendNewOrderSms_V2($name, $price,$number)
{
    $curl = curl_init();

    $data = [
        "code" => "de2bsqxz3oz1cuv", // کد Pattern
        "attributes" => [
            "name" => $name,
            "price" => $price
            // اگر Pattern فقط یک متغیر دارد، همین کافی است
        ],
        "recipient" => $number,
        "line_number" => "50002178584000",
        "number_format" => "english"
    ];

    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://api.iranpayamak.com/ws/v1/sms/pattern',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => [
            'Accept: application/json',
            'Api-Key: ' . env('SMS_API_KEY'),,
            'Content-Type: application/json',
        ],
    ]);

    $response = curl_exec($curl);

    if ($response === false) {
        $error = curl_error($curl);
        curl_close($curl);

        throw new Exception("SMS API Error: " . $error);
    }

    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);

    return [
        'status' => $httpCode,
        'response' => json_decode($response, true),
    ];

}


function sendAlertOrderSms($name, $id){
    $client = new SoapClient("http://188.0.240.110/class/sms/wsdlservice/server.php?wsdl");
    $user = env("SMS_USERNAME");
    $pass = env("SMS_PASSWORD");
    $fromNum = "+3000505";
    $toNum = array("09139638917");
    $pattern_code = "l2fnlhzvzettsam";
    $input_data = array(
        "name" => $name,
        "id" => $id
    );
    echo $client->sendPatternSms($fromNum, $toNum, $user, $pass, $pattern_code, $input_data);
}

function sendAlertOrderSms_V2($name, $id){
    $curl = curl_init();

    $data = [
        "code" => "l2fnlhzvzettsam", // کد Pattern
        "attributes" => [
            "name" => $name,
            "id" => $id
            // اگر Pattern فقط یک متغیر دارد، همین کافی است
        ],
        "recipient" => "09139638917",
        "line_number" => "50002178584000",
        "number_format" => "english"
    ];

    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://api.iranpayamak.com/ws/v1/sms/pattern',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => [
            'Accept: application/json',
            'Api-Key: ' . env('SMS_API_KEY'),,
            'Content-Type: application/json',
        ],
    ]);

    $response = curl_exec($curl);

    if ($response === false) {
        $error = curl_error($curl);
        curl_close($curl);

        throw new Exception("SMS API Error: " . $error);
    }

    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);

    return [
        'status' => $httpCode,
        'response' => json_decode($response, true),
    ];
}
