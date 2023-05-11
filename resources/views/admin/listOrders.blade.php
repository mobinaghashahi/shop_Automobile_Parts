<html>

<head>

    <link href="/css/style.css" rel="stylesheet">
</head>
<body style="margin: 8px">
<div style="width: 8.3in; height: 5.8in;border: 2px solid #000000;">
    <div style="width: 100%;float: right">
        <div style="position: absolute;float: right;padding: 15px">
            <img src="/logo/logo.png" width="60" height="60">
        </div>
        <div style="width:100%;float: right;padding: 15px;font-family: 'B Nazanin';text-align: center">
            <p style="line-height: 5px;font-weight: bolder;font-size: 20px">لوازم یدکی اصلی</p>
            <p style="line-height: 10px;color: #444444">لیست اقلام خریداری شده</p>
        </div>
    </div>
    <hr style="width: 90%">
    <div style="width: 100%;display: flex;justify-content: center;margin-top: 60px">
        <div style="width: 80%;">
            <table style="width:100%;direction: rtl;background-color: #ffffff;">
                <tr>
                    <th>ردیف</th>
                    <th>نام محصول</th>
                    <th>تعداد</th>
                </tr>
                @foreach($listOrders as $listOrder)
                <tr>
                    <th>{{$loop->index+1}}</th>
                    <th>{{$listOrder->name}}</th>
                    <th>{{$listOrder->count}}</th>
                </tr>
                @endforeach

            </table>
        </div>
    </div>
</div>
</body>
</html>
