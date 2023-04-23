@extends('layout.master')

@section('content')
    <div class="col-12" style="display: flex;justify-content: center">
        <div class="col-3 loginForm" style="padding: 40px 0px 40px 0px">
            <form method="post" name="enter" action="/register">
                @csrf
                @if (\Session::has('msg'))
                    <div class="notification notificationSuccess">
                        <p>{!! \Session::get('msg') !!}</p>
                        <span class="notification_progress"></span>
                    </div>
                @endif
                @if ($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="notification notificationError">
                            <p>{{$error}}</p>
                            <span class="notification_progress"></span>
                        </div>
                    @endforeach
                @endif
                <div class="col-12 divLabelInput">
                    <a>موبایل</a>
                </div>
                <div class="col-12" style="display: flex;justify-content: center">
                    <input name="phoneNumber" type="text" class="inputText">
                </div>
                <div class="col-12 divLabelInput">
                    <a>نام و نام خانوادگی</a>
                </div>
                <div class="col-12 divInputText">
                    <input name="nameAndFamily" type="text" class="inputText">
                </div>
                <div class="col-12 divLabelInput">
                    <a>رمز عبور</a>
                </div>
                <div class="col-12 divInputText">
                    <input name="password" class="inputText" type="password">
                </div>
                <div class="col-12 divLabelInput">
                    <a>تکرار رمز عبور</a>
                </div>
                <div class="col-12 divInputText">
                    <input name="password_confirmation" type="password" class="inputText" type="password">
                </div>
                <div class="col-12" style="display: flex;justify-content: center">
                    <div style="padding-top: 20px">
                        {!! Anhskohbo\NoCaptcha\Facades\NoCaptcha::renderJs() !!}
                        {!! Anhskohbo\NoCaptcha\Facades\NoCaptcha::display() !!}
                    </div>
                </div>
                <div class="col-12 divInputSubmit">
                    <input name="enter" class="inputSubmit" type="submit" value="ثبت نام">
                </div>
                <div class="col-12" style="text-align: right;text-align: right;direction: rtl">
                    <div style="text-align: right;direction: rtl;display: inline">
                        <a href="/login" style="color: black;text-decoration: none">از قبل حساب دارید؟</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
