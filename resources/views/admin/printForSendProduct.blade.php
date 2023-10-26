<html>

<head>
    <link href="/css/style.css" rel="stylesheet">
</head>
<body style="margin: 8px">
<div style="width: 8.3in; height: 5.8in;border: 2px solid #000000;">
    <div style="width: 100%;float: right">
        <div style="width: 10%;float: right;padding: 15px">
            <img src="/logo/logo.png" width="60" height="60">
        </div>
        <div style="width: 50%;float: right;padding: 15px;font-family: 'B Nazanin';text-align: right">
            <p style="line-height: 5px">صندوق پستی: 546546465</p>
            <p style="line-height: 5px">شماره تلفن: 09129231997</p>
        </div>
    </div>
    <hr style="width: 90%">
    <div style="width: 100%;float: right;padding: 15px;font-family: Vazir;text-align: right;direction: rtl;padding-top: 80px;padding-right: 50px">
        <p>آدرس: {{$cart[0]->provinceCity."- ".$cart[0]->cityName."- ".$cart[0]->address}}</p>
        <a>کد پستی: {{$cart[0]->postCode}}</a>
        <a>|</a>
        <a>شماره تلفن: {{$cart[0]->phoneNumber}}</a>
    </div>
    <div style="width: 100%;display: flex;justify-content: center">
        <div style="width: 80%;">
            <table style="width:100%;direction: rtl;background-color: #ffffff;">
                <tr>
                    <th>فرستنده</th>
                    <th>دانیال باقری</th>
                </tr>
                <tr>
                    <th>گیرنده</th>
                    <th>{{$cart[0]->nameAndFamily}}</th>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>
