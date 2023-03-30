@extends('layout.master')

@section('content')
    <div class="col-12" style="margin-bottom: 25px;margin-top: 25px">
        @include('user.menu')
        <div class="col-8" style="margin-top: 30px;margin-right: 20px">
            <div class="col-12" style="direction: rtl">
                <form method="post" action="profile">
                    <div class="col-12" style="display: flex;justify-content: center">
                        <div class="col-4">
                            @if ($errors->any())
                                @foreach($errors->all() as $error)
                                    <div class="col-12" style="justify-content: center;display: flex">
                                        <div class="col-12">
                                            <p style="color: #ffffff;text-align: center;background-color: #ff2e2e;direction:rtl;line-height: 15px;padding: 10px;border-radius: 10px">{{$error}}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    @csrf
                    <div class="col-6">
                        <div class="col-11">
                            <label>نام و نام خانوادگی<span style="color: red">*</span></label>
                            <input name="nameAndFamily" value="{{Auth::user()->nameAndFamily}}" type="text"
                                   class="inputText">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="col-11">
                            <label>شماره موبایل<span style="color: red">*</span></label>
                            <input name="phoneNumber" value="{{Auth::user()->phoneNumber}}" type="text"
                                   class="inputText">
                        </div>
                    </div>
                    <div class="col-6" style="margin-top: 10px">
                        <div class="col-11">
                            <label>آدرس<span style="color: red">*</span></label>
                            <input name="address" value="{{Auth::user()->address}}" type="text" class="inputText">
                        </div>
                    </div>
                    <div class="col-6" style="margin-top: 10px">
                        <div class="col-11">
                            <label>کد پستی<span style="color: red">*</span></label>
                            <input name="postCode" value="{{Auth::user()->postCode}}" type="text" class="inputText">
                        </div>
                    </div>
                    <div class="col-12" style="margin-top: 20px">
                        <fieldset class="fieldsetPassword">
                            <legend>
                                تغییر گذرواژه
                            </legend>
                            <div class="col-11" style="padding-top: 10px">
                                <label>
                                    گذرواژه پیشین (در صورتی که قصد تغییر ندارید خالی بگذارید)
                                </label>
                                <input name="oldPassword" type="text"
                                       class="inputText">
                            </div>
                            <div class="col-11" style="padding-top: 20px">
                                <label>
                                    گذرواژه جدید (در صورتی که قصد تغییر ندارید خالی بگذارید)
                                </label>
                                <input name="newPassword" type="text"
                                       class="inputText">
                            </div>
                            <div class="col-11" style="padding-top: 20px;padding-bottom: 20px">
                                <label>
                                    تکرار گذرواژه جدید
                                </label>
                                <input name="passwordConfirmation" type="text"
                                       class="inputText">
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-3" style="padding-top: 20px">
                        <input type="submit" class="inputSubmit" value="ثبت تغییرات">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
