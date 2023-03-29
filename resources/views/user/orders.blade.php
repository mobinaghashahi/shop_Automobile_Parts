@extends('layout.master')
@section('content')
    <div class="col-12" style="margin-bottom: 25px;margin-top: 25px">
        @include('user.menu')
        <div class="col-8" style="margin-top: 40px;margin-right: 20px">
            @if($orders->count()!=0)
                <div class="col-12" style="direction: rtl;">
                    <table>
                        <tr>
                            <th>کد</th>
                            <th>وضعیت</th>
                            <th>مجموع</th>
                            <th>عملیات</th>
                        </tr>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->paymentCode}}</td>
                                @if($order->state==0)
                                    <td>در دست اقدام</td>
                                @else
                                    <td>ارسال شده</td>
                                @endif
                                <td>{{number_format(calSumPrice($order->id))}} </td>
                                <td>
                                    <div class="col-12">
                                        <a href="/user/orderDetails/{{$order->id}}" class="inputSubmit"
                                           style="text-decoration: none;color: black;">
                                            نمایش</a>
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
