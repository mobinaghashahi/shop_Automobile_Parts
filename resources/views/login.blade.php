@extends('layout.master')

@section('content')
    <div class="col-12" style="display: flex;justify-content: center">
        <div class="col-3 loginForm" style="padding: 50px 0px 50px 0px">
            @if (\Session::has('msg'))
                <div class="successMessage">
                    ثبت نام با موفقیت انجام شد
                </div>
            @endif
            @if ($errors->any())
                @foreach($errors->all() as $error)
                    <div class="col-12" style="justify-content: center;display: flex">
                        <div class="col-12">
                            <p style="color: #ffffff;text-align: center;background-color: #ff2e2e;direction:rtl;line-height: 15px;padding: 10px;border-radius: 10px">{{$error}}</p>
                        </div>
                    </div>
                @endforeach
            @endif
            <form method="post" name="enter" action="/login">
                @csrf
                <div class="col-12 divLabelInput">
                    <a>موبایل</a>
                </div>
                <div class="col-12 divInputText">
                    <input name="phoneNumber" type="text" class="inputText" style="width: 100%;">
                </div>

                <div class="col-12 divLabelInput">
                    <a>رمز عبور</a>
                </div>
                <div class="col-12 divInputText">
                    <input name="password" type="password"
                           style="width: 100%;border-radius: 10px;height: 30px;border-color: #ed6a12;box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);">
                </div>
                <div class="col-12 divInputSubmit">
                    <input name="enter" class="inputSubmit" type="submit" value="ورود">
                </div>
                <div class="col-12" style="text-align: right;text-align: right;direction: rtl">
                    <div style="text-align: right;direction: rtl;display: inline">
                        <a href="/register" style="color: black;text-decoration: none"> حساب کاربری ندارید؟ ثبت نام
                            کنید.</a>
                    </div>
                    <div style="text-align: left;direction: rtl;display: inline;float: left">
                        <a href="#">تغییر گذرواژه</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
