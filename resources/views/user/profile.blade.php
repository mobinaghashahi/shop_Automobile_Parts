@extends('layout.master')

@section('content')
    <div class="col-12" style="margin-bottom: 25px;margin-top: 25px">
        @include('user.menu')
        <div class="col-8" style="margin-top: 30px;margin-right: 20px">
            <div class="col-12" style="direction: rtl">
                <div class="col-6">
                    <div class="col-11">
                        <label>نام و نام خانوادگی<span style="color: red">*</span></label>
                        <input value="{{Auth::user()->nameAndFamily}}" type="text" class="inputText">
                    </div>
                </div>
                <div class="col-6">
                    <div class="col-11">
                        <label>شماره موبایل<span style="color: red">*</span></label>
                        <input value="{{Auth::user()->phoneNumber}}" type="text" class="inputText">
                    </div>
                </div>
                <div class="col-6" style="margin-top: 10px">
                    <div class="col-11">
                        <label>آدرس<span style="color: red">*</span></label>
                        <input value="{{Auth::user()->address}}" type="text" class="inputText">
                    </div>
                </div>
                <div class="col-6" style="margin-top: 10px">
                    <div class="col-11">
                        <label>آدرس<span style="color: red">*</span></label>
                        <input value="{{Auth::user()->address}}" type="text" class="inputText">
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
                            <input value="{{Auth::user()->address}}" type="text" class="inputText">
                        </div>
                        <div class="col-11" style="padding-top: 20px">
                            <label>
                                گذرواژه جدید (در صورتی که قصد تغییر ندارید خالی بگذارید)
                            </label>
                            <input value="{{Auth::user()->address}}" type="text" class="inputText">
                        </div>
                        <div class="col-11" style="padding-top: 20px;padding-bottom: 20px">
                            <label>
                                تکرار گذرواژه جدید
                            </label>
                            <input value="{{Auth::user()->address}}" type="text" class="inputText">
                        </div>
                    </fieldset>
                </div>
                <div class="col-3" style="padding-top: 20px">
                    <input type="submit" class="inputSubmit" value="ثبت تغییرات">
                </div>
            </div>
        </div>
    </div>
@endsection
