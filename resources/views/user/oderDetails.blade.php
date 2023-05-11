@extends('layout.master')
@section('content')
    <div class="col-12" style="margin-bottom: 25px;margin-top: 25px">
        @include('user.menu')
        <div class="col-8" style="margin-top: 40px;margin-right: 20px">
                <div class="col-12" style="direction: rtl;">
                    @if($buys->count()!=0)
                    <table>
                        <tr>
                            <th>محصول</th>
                            <th>تعداد</th>
                            <th>قیمت واحد</th>
                            <th>قیمت کل</th>
                        </tr>
                        @foreach($buys as $buy)
                            <tr>
                                <td>{{$buy->name}}</td>
                                <td>{{$buy->count}} </td>
                                <td>{{number_format($buy->price)}}</td>
                                <td>{{number_format($buy->count*$buy->price)}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th>جمع پرداخت</th>
                            <td  colspan="3">{{number_format(calSumPrice($buy->cartId))}}</td>
                        </tr>
                    </table>
                    @else
                        <p style="text-align: center">محصولی در لیست وجود ندارد.</p>
                    @endif
                </div>
        </div>

        @
    </div>
@endsection
