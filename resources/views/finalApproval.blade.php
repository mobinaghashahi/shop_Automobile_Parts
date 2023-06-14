@extends("layout.master")
@section('content')

    <div class="col-12 blockCart">
        @if (\Session::has('error'))
            <div class="notification notificationError">
                <p>{!! \Session::get('error') !!}</p>
                <span class="notification_progress"></span>
            </div>
        @endif
        <div class="col-11 blockCartRight">
            <p style="font-size: 20px;padding-right: 20px">نشانی ارسال</p>
            <hr style=" background-color: rgba(101,101,101,0.84);height: 2px; border: none;">
            <div class="col-12" style="margin-right: 10px;display: flex;justify-content: center">
                <div style="margin-left:5px">
                    <img src="/logo/location1.png" width="60" height="60">
                </div>
                <div style="width: 98%">
                    <p style="color: #8f8f8f">{{$currentLocation[0]->provinceCity}}- {{$currentLocation[0]->cityName}}
                        - {{Auth::user()->address}}</p>
                    <form action="/user/profile" method="get">
                        @csrf
                        <div class="col-3" style="display:flex;justify-content: center">
                            <input style="" name="enter" class="inputChange" type="submit" value="ویرایش">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 blockCart">
        <div class="col-11 blockCartRight">
            <p style="font-size: 20px;padding-right: 20px">نوع ارسال</p>
            <hr style=" background-color: rgba(101,101,101,0.84);height: 2px; border: none;">
            <div class="col-12" style="margin-right: 10px">
                <div class="col-6" style="display: flex;justify-content: center">
                    <div style="margin-left:5px ">
                        <img src="/logo/post.png" width="60" height="60">
                    </div>
                    <div style="width: 90%">
                        <p style="color: #8f8f8f"><span style="font-size: 10px">ارسال با پست پیشتاز | ارسال توسط اداره پست جمهوری اسلامی</span>
                        </p>
                    </div>
                </div>
                <div class="col-5">
                    <p class="centerTextMobile" style="color: #8f8f8f;">
                        هزینه ارسال و بسته بندی
                        @if($sendPrice!=0)
                            {{number_format($sendPrice)}}
                            تومان
                        @else
                            <span style="color: #43c200;font-size: 20px;font-weight: bolder">رایگان!!</span>
                        @endif
                    </p>
                </div>
                <div class="col-12">
                    <p>
                        ارسال به سراسر ایران به مبلغ 200 هزارتومن انجام میشود و ارسال برای تهران رایگان است.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 blockCart">
        <div class="col-11 blockCartRight">
            <p style="font-size: 20px;padding-right: 20px">صورت حساب</p>
            <hr style=" background-color: rgba(101,101,101,0.84);height: 2px; border: none;">
            <div class="col-12" style="margin-right: 10px;display: flex;justify-content: center">
                <div style="margin-left:5px">
                    <img src="/logo/pos.png" width="60" height="60">
                </div>
                <div style="width: 95%">
                    <p style="color: #8f8f8f;">
                        <span style="color: black;font-weight: bolder">خرید شما:</span> {{number_format($totalPrice)}} هزار تومان
                    </p>
                    <p style="color: #8f8f8f;">
                        <span style="color: black;font-weight: bolder">هزینه ارسال:</span> {{number_format($sendPrice)}} هزار تومان
                    </p>
                    <p style="color: #8f8f8f;">
                        <span style="color: black;font-weight: bolder">مبلغ قابل پرداخت:</span> {{number_format($sendPrice+$totalPrice)}} هزار تومان
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 blockCart">
        <div class="col-11 blockCartRight">
            <p style="font-size: 20px;padding-right: 20px">درگاه پرداخت</p>
            <hr style=" background-color: rgba(101,101,101,0.84);height: 2px; border: none;">
            <div class="col-12" style="margin-right: 10px;display: flex;justify-content: center">
                <div style="margin-left:5px">
                    <img src="/logo/zarinpal.jpg" width="60" height="60">
                </div>
                <div style="width: 95%">
                    <p style="color: #8f8f8f;">
                        درگاه زرین پال | <span style="font-size: 10px">پرداخت آنلاین توسط درگاه زرین پال</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12" style="display: flex;justify-content: center">
        <div class="col-11">
            <div class="col-6">
                <div class="col-5">
                    <form action="/cart/showCart" method="get">
                        <input name="enter" class="inputBack" type="submit" value="بازگشت">
                    </form>
                </div>
            </div>
            <div class="col-6">
                <div class="col-5" style="float: left">
                    <form action="/payment/pay" method="post">
                        @csrf
                        <input name="enter" class="inputPay" type="submit" value="پرداخت">
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
