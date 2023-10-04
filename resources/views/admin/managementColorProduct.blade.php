@extends('admin.menu')
@section('content')

    <div class="main">
        <div class="col-12" style="text-align: center;padding-top: 15px;">
            <a style="background-color: #363636;padding: 10px;border-radius: 5px;color: white">رنگ های محصول</a>
        </div>
        <div class="blockOfInputs">
            <div class="col-12" style="padding-top: 50px;display: flex;justify-content: center">
                <div class="col-11">
                    @if (\Session::has('msg'))
                        <div class="notification notificationSuccess">
                            <p>{!! \Session::get('msg') !!}</p>
                            <span class="notification_progress"></span>
                        </div>
                    @endif
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="notification notificationError">
                                <p>{{$error}}</p>
                                <span class="notification_progress"></span>
                            </div>
                        @endforeach
                    @endif
                    <table>
                        <tr>
                            <th class="editeTables"> ردیف</th>
                            <th class="editeTables">نام محصول</th>
                            <th class="editeTables">اختلاف با قیمت پایه</th>
                            <th class="editeTables">رنگ</th>
                            <th class="editeTables">مدیریت رنگ</th>
                        </tr>
                        @foreach ($colorProducts as $colorProduct)
                            <tr>
                                <td class="editeTables">{{$loop->index+1}}</td>
                                <td>{{$colorProduct['name']}}</td>
                                <td>{{$colorProduct['differentPrice']}}</td>
                                <td><span style="height: 25px;width: 25px;background-color: {{$colorProduct['hexColorCode']}};border-radius: 50%;display: inline-block;"></span></td>
                                <td>
                                    <div class="col-12">
                                        <a href="/admin/deleteColorProduct/{{$productId}}/{{$colorProduct['productColorId']}}"> <img src="/logo/delete.png" width="15" height="15"></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5" style="background-color: #43c200">
                                <a href="/admin/addColorProduct/{{$productId}}">
                                    <img src="/logo/add.png" width="25" height="25" style="margin: auto">
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
