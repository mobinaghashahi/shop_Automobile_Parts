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
            <form method="post" name="enter" action="/enterForgetPasswordCode">
                @csrf
                <div class="col-12" style="direction: rtl;text-align: justify;text-justify: inter-word;">
                    <p>
                        کد بازیابی به شماره موبایل شما ارسال شد، کد ارسال شده را در کادر زیر وارد کنید.
                    </p>
                </div>
                <div class="col-12 divLabelInput" style="padding: 0px">
                    <a>کد</a>
                </div>
                <div class="col-12 divInputText">
                    <input name="code" type="text" class="inputText" style="width: 100%;">
                </div>
                <div class="col-12 divInputText">
                    <input hidden name="phoneNumber" value="{{$encryptPhoneNumber}}" type="text" class="inputText" style="width: 100%;">
                </div>
                <div class="col-12 divInputSubmit">
                    <input name="enter" class="inputSubmit" type="submit" value="تایید">
                </div>
            </form>
        </div>
    </div>
@endsection
