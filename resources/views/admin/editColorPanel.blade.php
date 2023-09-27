@extends('admin.menu')
@section('content')
    <div class="main">
        <div class="col-12" style="text-align: center;padding-top: 15px;">
            <a style="background-color: #363636;padding: 10px;border-radius: 5px;color: white">ویرایش دسته بندی ها</a>
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
                            <th class="editeTables" style="width: 50px">ردیف</th>
                            <th class="editeTables">کد</th>
                            <th class="editeTables">نام رنگ</th>
                            <th class="editeTables">رنگ</th>
                            <th class="editeTables">عملیات</th>
                        </tr>
                        @foreach ($colors as $color)
                            <tr>
                                <td class="editeTables">{{$loop->index+1}}</td>
                                <td>{{$color->id}}#</td>
                                <td>{{$color->name}}</td>
                                <td><span style="height: 25px;width: 25px;background-color: {{$color->hexColorCode}};border-radius: 50%;display: inline-block;"></span></td>
                                <td>
                                    <div class="col-6">
                                        <a href="/admin/deleteColor/{{$color->id}}"> <img src="/logo/delete.png" width="15" height="15"></a>
                                    </div>
                                    <div class="col-6">
                                        <a href="/admin/editColor/{{$color->id}}"> <img src="/logo/pen.png" width="15" height="15"></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
