@extends('layout.master')
@section('content')
    <div class="col-12" style="margin-bottom: 25px;margin-top: 25px">
        @include('user.menu')
        @if (\Session::has('msg'))
            <div class="notification notificationSuccess">
                <p>{!! \Session::get('msg') !!}</p>
                <span class="notification_progress"></span>
            </div>
        @endif
        <div class="col-8" style="margin-top: 40px;margin-right: 20px">
            @if($orders->count()!=0)
                <div class="col-12" style="direction: rtl;">
                    <table>
                        <tr>
                            <th>کد</th>
                            <th>وضعیت</th>
                            <th>مجموع</th>
                            <th>کد پیگیری</th>
                            <th>عملیات</th>
                        </tr>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->paymentCode}}</td>
                                @if($order->state==0)
                                    <td>در دست اقدام</td>
                                @elseif($order->state==1)
                                    <td style="background-color: #4DC7A0">ارسال شده</td>
                                @elseif($order->state==2)
                                    <td style="background-color: #c74d4d">لغو شده</td>
                                @endif
                                <td>{{number_format($order->totalPrice)}} </td>
                                <td>{{$order->sendPostCode}} </td>
                                <td>
                                    <div class="col-12" style="display:flex;justify-content: center">
                                        <a href="/user/orderDetails/{{$order->id}}" class="inputSubmit"
                                           style="text-decoration: none;color: black;">
                                            جزئیات</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @else
                <div class="col-12" style="text-align: center">
                    <a>
                        تابحال سفارشی ثبت نشده است
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
