@extends('layout.master')

@section('content')
    <div class="col-12" style="display: flex;justify-content: center">
        <div class="col-3 loginForm" style="padding: 50px 0px 50px 0px">
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
            <form method="post" name="enter" action="/forgetPasswordSendSms">
                @csrf
                <div class="col-12" style="direction: rtl;text-align: justify;text-justify: inter-word;">
                    <p>
                        گذرواژه خود را فراموش کرده اید؟ شماره موبایل خود را وارد کنید. کد بازیابی به شماره شما ارسال خواهد شد.
                    </p>
                </div>
                <div class="col-12 divLabelInput" style="padding: 0px">
                    <a>موبایل</a>
                </div>
                <div class="col-12 divInputText">
                    <input name="phoneNumber" type="text" class="inputText" style="width: 100%;">
                </div>
                <div class="col-12" style="display: flex;justify-content: center">
                    <div style="padding-top: 20px">
                        {!! Anhskohbo\NoCaptcha\Facades\NoCaptcha::renderJs() !!}
                        {!! Anhskohbo\NoCaptcha\Facades\NoCaptcha::display() !!}
                    </div>
                </div>
                <div class="col-12 divInputSubmit">
                    <input name="enter" class="inputSubmit" type="submit" value="ارسال کد">
                </div>
                <div class="col-12" style="text-align: right;text-align: right;direction: rtl">
                    <div style="text-align: right;direction: rtl;display: inline">
                        <a href="/register" style="color: black;text-decoration: none"> حساب کاربری ندارید؟ ثبت نام
                            کنید.</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
