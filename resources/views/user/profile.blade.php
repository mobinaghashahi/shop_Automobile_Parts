@extends('layout.master')
@section('content')
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
                <span style="background-image: linear-gradient(to right,#ffffff,#7c7c7c);"
                      class="notification_progress"></span>
            </div>
        @endforeach
    @endif
    <div class="col-12" style="margin-bottom: 25px;margin-top: 25px">

        @include('user.menu')
        <div class="col-8 profileForm">
            <div class="col-12" style="direction: rtl">
                <form method="post" action="profile">
                    <div class="col-12" style="display: flex;justify-content: center">
                        <div class="col-4">

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

                            <label>استان<span style="color: red">*</span></label>
                            <select class="inputText" id="state" name="state" style="height: 37px;padding-right: 3px">
                                @if($currentLocation->count()==0)
                                    <option value="0" selected disabled>استان را انتخاب کنید</option>
                                @else
                                    <option value="{{$currentLocation[0]->provinceId}}">{{$currentLocation[0]->provinceCity}}</option>
                                @endif
                                @foreach($provices as $provice)
                                    <option style="font-size: 15px" value="{{$provice->id}}">{{$provice->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6" style="margin-top: 10px">
                        <div class="col-11">
                            <label>شهرستان<span style="color: red">*</span></label>
                            <select class="inputText" id="city" name="city" style="height: 37px;padding-right: 3px">
                                @if($currentLocation->count()==0)
                                    <option value="0" selected disabled>شهر را انتخاب کنید</option>
                                @else
                                    <option value="{{$currentLocation[0]->cityId}}">{{$currentLocation[0]->cityName}}</option>
                                @endif

                            </select>
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
                                <input name="oldPassword" type="password"
                                       class="inputText">
                            </div>
                            <div class="col-11" style="padding-top: 20px">
                                <label>
                                    گذرواژه جدید (در صورتی که قصد تغییر ندارید خالی بگذارید)
                                </label>
                                <input name="newPassword" type="password"
                                       class="inputText">
                            </div>
                            <div class="col-11" style="padding-top: 20px;padding-bottom: 20px">
                                <label>
                                    تکرار گذرواژه جدید
                                </label>
                                <input name="passwordConfirmation" type="password"
                                       class="inputText">
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-3">
                        <input type="submit" class="inputSubmit submitProfileChange" value="ثبت تغییرات">
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
