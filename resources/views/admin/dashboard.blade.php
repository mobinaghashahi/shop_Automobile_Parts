@extends('admin.menu')
@section('content')


    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2", // "light1", "light2", "dark1", "dark2"
                data: [{
                    type: "column",

                    legendMarkerColor: "grey",
                    legendText: "MMbbl = one million barrels",
                    dataPoints: [
                        @for($i=30;$i>=0;$i--)
                        { y: {{$visitedMonthAgo[$i][1]}}, label: '{{$visitedMonthAgo[$i][0]}}' },
                        @endfor
                    ]
                }]
            });
            chart.render();

        }
    </script>
    <div class="main col-10" style="float: left">
        <h2 style="text-align: center">به پنل مدیریتی خوش آمدید</h2>
        <div class="col-12" style="background-color: #4a5568;display: flex;justify-content: center;padding-top: 10px;padding-bottom:30px;border-radius: 10px">
            <div class="col-11">
                <div class="col-12" style="display: flex;justify-content: center">
                    <div class="col-3" style="font-size: 25px">
                        <p style="text-align: center;color: white;font-size: larger;text-shadow: 2px 0 black">سفارشات جدید</p>
                    </div>
                </div>

                @if($orders->count()!=0)
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
                @else
                    <p style="text-align: center;font-weight: bolder;color: #e2e8f0;font-size: 15px;direction: rtl">سفارش جدیدی وجود ندارد.</p>
                @endif
            </div>

        </div>
        <div class="col-12" style="margin-top:20px;background-color: #373f4d;display: flex;justify-content: center;padding-top: 10px;padding-bottom:30px;border-radius: 10px">
            <div class="col-11">
                <div class="col-12" style="display: flex;justify-content: center">
                    <div class="col-3" style="font-size: 25px">
                        <p style="text-align: center;color: white;font-size: larger;text-shadow: 2px 0 black">گزارش بازدید</p>
                    </div>
                </div>
                <div class="col-12">
                    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
