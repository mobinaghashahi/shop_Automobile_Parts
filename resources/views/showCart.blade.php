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
                        <td><a style="text-decoration: none;color: black" href="/productDetails/{{$value[0]['id']}}">{{$value[0]['name']}}</a></td>
                        <td>{{number_format($value[0]['price'])}} </td>
                        <td>
                            <div >
                                <form style="width: 100%;height: 100%" action="/cart/increaseCount" method="post">
                                    @csrf
                                    <input type="text" hidden name="id" value="{{$value[0]['id']}}">
                                    <input type="text" hidden name="count" value="{{session('products.'.$value[0]['id'])+1}}">
                                    <div style="float: right;width: 20%">
                                        <input name="operation"  type="submit" value="+" style="width: 20%;margin: 0px;padding: 0px;height: 5%;width: 20px">
                                    </div>
                                </form>
                                <form style="width: 100%;height: 100%" action="/cart/decreaseCount" method="post">
                                    @csrf
                                    <input type="text" hidden name="id" value="{{$value[0]['id']}}">
                                    <input type="text" hidden name="count" value="{{session('products.'.$value[0]['id'])-1}}">
                                    <div style="float: right;width: 50%;padding-right: 4px ">
                                        <span style="padding: 5px;text-align: center">{{session('products.'.$value[0]['id'])}}</span>
                                    </div>
                                    <div style="float: right;width: 20%">
                                        <input name="operation" type="submit" value="-" style="width: 20%;margin: 0px;padding: 0px;height: 5%;width: 20px">
                                    </div>
                                </form>
                            </div>
                        <td>
                            <div class="col-12">
                                <a href="/cart/deleteOfCart/{{$value[0]['id']}}"> <img width="15" height="15" src="/logo/delete.png" title="حذف کردن" alt="ضربدر"></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
