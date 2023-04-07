@extends("layout.master")
@section('content')
    <div class="col-12" style="direction: rtl;display: flex;justify-content: center">
        <div class="col-9" style="padding: 20px">
            <table>
                <tr>
                    <th>ردیف</th>
                    <th>نام محصول</th>
                    <th>قیمت (جزء)</th>
                    <th>تعداد</th>
                    <th>عملیات</th>
                </tr>
                @foreach($products as  $value)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$value[0]['name']}}</td>
                        <td>{{number_format($value[0]['price'])}} </td>
                        <td>{{session('products.'.$value[0]['id'])}} </td>
                        <td>
                            <div class="col-12">
                                <a href="/cart/deleteOfCart/{{$value[0]['id']}}"> <img width="15" height="15" src="/logo/delete.png"></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
