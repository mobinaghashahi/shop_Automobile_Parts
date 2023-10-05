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
    <form action="/payment/pay" method="post">
        <div class="col-12" style="margin-bottom: 25px;margin-top: 25px">
            <div class="col-7 profileForm">
                <div class="col-12" style="direction: rtl">
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
                                    <option
                                        value="{{$currentLocation[0]->provinceId}}">{{$currentLocation[0]->provinceCity}}</option>
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
                                    <option
                                        value="{{$currentLocation[0]->cityId}}">{{$currentLocation[0]->cityName}}</option>
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
                </div>
            </div>
            <div class="col-4 blockPayLeft">
                <div class="col-6">
                    <p style="padding-right: 20px">قیمت کالا ها:</p>
                </div>
                <div class="col-6">
                    <p style="padding-right: 20px; direction: rtl"><b>{{number_format($totalPrice)}} تومان</b></p>
                </div>
                <div class="col-12">
                    <p style="padding-right: 20px">حمل و نقل</p>
                </div>
                <div style="width: 95%;display: flex;justify-content: center">
                    <div class="col-10 postDetail" style="border: solid 2px #9b9b9b;border-radius: 10px">
                        <div style="width: 80%;float: right">
                            <a style="color: #8f8f8f;">
                                تیپاکس | <span style="font-size: 10px">پرداخت هزینه ارسال هنگام تحویل</span>
                            </a>
                        </div>
                        <div style="width: 10%;float: left;padding-top: 20px">
                            <input type="radio" checked="checked" style="">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <p style="padding-right: 20px">درگاه پرداخت</p>
                </div>
                <div style="width: 95%;display: flex;justify-content: center">
                    <div class="col-10 pay" style="border: solid 2px #9b9b9b;border-radius: 10px">
                        <a style="color: #8f8f8f;">
                            درگاه زرین پال | <span style="font-size: 10px">پرداخت آنلاین توسط درگاه زرین پال</span>
                        </a>
                        <div style="width: 10%;float: left;padding-top: 20px">
                            <input type="radio" checked="checked" style="">
                        </div>
                    </div>
                </div>
                <div class="col-12" style="padding: 20px 0px 10px 0px">
                    <hr style="width: 80%;color: rgba(0,0,0,0.8);">
                </div>
                <div class="col-4">
                    <p style="padding-right: 20px">هزینه ارسال:</p>
                </div>
                <div class="col-8">
                    <p style="direction: rtl;"><b>پرداخت هزینه ارسال هنگام تحویل</b></p>
                </div>
                <div class="col-6">
                    <p style="padding-right: 20px">مجموع:</p>
                </div>
                <div class="col-6">
                    <p style="padding-right: 20px; direction: rtl"><b>{{number_format($totalPrice)}} تومان</b></p>
                </div>

                @csrf
                <div class="col-12" style="display: flex;justify-content: center">
                    <input style="color:#000000;width: 90%;" name="enter" class="inputPay" type="submit" value="پرداخت">
                </div>
            </div>
        </div>
    </form>

@endsection
