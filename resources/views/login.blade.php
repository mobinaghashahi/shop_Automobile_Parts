@extends('layout.master')

@section('content')
    <div class="col-12" style="display: flex;justify-content: center">
        <div class="col-3 loginForm" style="padding: 50px 0px 50px 0px">
            <div class="col-12" style="text-align: right">
                <a>موبایل</a>
            </div>
            <div class="col-12" style="display: flex;justify-content: center">
                <input type="text" style="width: 100%;border-radius: 10px;height: 30px;border-color: #ed6a12;box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);">
            </div>
            <div class="col-12" style="text-align: right;padding-top: 15px">
                <a>رمز عبور</a>
            </div>
            <div class="col-12" style="display: flex;justify-content: center">
                <input type="text" style="width: 100%;border-radius: 10px;height: 30px;border-color: #ed6a12;box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);">
            </div>
            <div class="col-12" style="display: flex;justify-content: center;padding-top: 25px">
                <input type="submit" style="width: 100%;background-color: #ed6a12;height:35px;color: white;" value="ورود">
            </div>
            <div class="col-12" style="text-align: right;text-align: right;direction: rtl">
                <div style="text-align: right;direction: rtl;display: inline">
                    <a > حساب کاربری ندارید؟ ثبت نام کنید.</a>
                </div>
                <div style="text-align: left;direction: rtl;display: inline;float: left">
                    <a href="#">تغییر گذرواژه</a>
                </div>

            </div>
        </div>
    </div>
@endsection
