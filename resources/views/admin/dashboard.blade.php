@extends('admin.menu')
@section('content')
    <div class="main col-10" style="float: left">
        <h2 style="text-align: center">به پنل مدیریتی خوش آمدید</h2>
        <div class="col-12" style="background-color: #4a5568;display: flex;justify-content: center;padding: 10px;border-radius: 10px">
            <div class="col-11">
                <p style="text-align: center;color: white">سفارشات جدید</p>
                <table style="direction: rtl;background-color: #ffffff;">
                    <tr>
                        <th>ردیف</th>
                        <th>نام خریدار</th>
                        <th>شناسه پرداخت</th>
                        <th>عملیات</th>
                    </tr>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$order->name}}</td>
                            <td>{{$order->paymentCode}}</td>
                            <td>
                                <div class="col-6">
                                    <a href="/admin/sendProduct/{{$order->id}}"> <img src="/logo/tick.png" width="25" height="25" alt="ارسال شد"></a>
                                </div>
                                <div class="col-6">
                                    <a href="/admin/printForSendProduct/{{$order->id}}"> <img src="/logo/printer.png" width="25" height="25"></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

        </div>
    </div>
@endsection
