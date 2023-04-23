@extends('layout.master')

@section('content')
    <div class="col-12" style="display: flex;justify-content: center">
        <div class="col-3 loginForm" style="padding: 40px 0px 40px 0px">
            <form method="post" name="enter" action="/changeForgetPassword">
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
                    <a>رمز عبور جدید</a>
                </div>
                <div class="col-12 divInputText">
                    <input name="password" type="password"
                           style="width: 100%;border-radius: 10px;height: 30px;border-color: #ed6a12;box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);">
                </div>
                <div class="col-12 divLabelInput">
                    <a>تکرار رمز عبور</a>
                </div>
                <div class="col-12 divInputText">
                    <input name="password_confirmation" type="password"
                           style="width: 100%;border-radius: 10px;height: 30px;border-color: #ed6a12;box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);">
                </div>
                <div class="col-12 divInputSubmit">
                    <input name="enter" class="inputSubmit" type="submit" value="تغییر رمز عبور">
                </div>
            </form>
        </div>
    </div>
@endsection
