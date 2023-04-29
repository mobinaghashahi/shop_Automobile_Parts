<?php

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

function sendNewOrderSms($name, $price)
{

    $client = new SoapClient("http://188.0.240.110/class/sms/wsdlservice/server.php?wsdl");
    $user = env("SMS_USERNAME");
    $pass = env("SMS_PASSWORD");
    $fromNum = "+3000505";
    $toNum = array("09139638917");
    $pattern_code = "de2bsqxz3oz1cuv";
    $input_data = array(
        "name" => $name,
        "price" => $price
    );
    echo $client->sendPatternSms($fromNum, $toNum, $user, $pass, $pattern_code, $input_data);
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
