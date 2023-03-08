@extends('layout.master')

@section('content')
    <div class="col-12" style="display: flex;justify-content: center">
        <div class="col-3 loginForm" style="padding: 40px 0px 40px 0px">
            <div class="col-12 divLabelInput">
                <a>موبایل</a>
            </div>
            <div class="col-12 divInputText" >
                <input type="text" class="inputText">
            </div>
            <div class="col-12 divLabelInput">
                <a>نام و نام خانوادگی</a>
            </div>
            <div class="col-12 divInputText" >
                <input type="text" class="inputText">
            </div>
            <div class="col-12 divLabelInput">
                <a>رمز عبور</a>
            </div>
            <div class="col-12 divInputText" >
                <input type="text" class="inputText">
            </div>
            <div class="col-12 divLabelInput">
                <a>تکرار رمز عبور</a>
            </div>
            <div class="col-12 divInputText" >
                <input type="text" class="inputText">
            </div>
            <div class="col-12 divInputSubmit">
                <input class="inputSubmit" type="submit" value="ورود">
            </div>
            <div class="col-12" style="text-align: right;text-align: right;direction: rtl">
                <div style="text-align: right;direction: rtl;display: inline">
                    <a href="/login" style="color: black;text-decoration: none">از قبل حساب دارید؟</a>
                </div>
            </div>
        </div>
    </div>
@endsection
