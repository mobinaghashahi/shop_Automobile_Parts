@extends('admin.menu')
@section('content')
    <div class="main">
        <div class="col-12" style="text-align: center;padding-top: 15px;">
            <a style="background-color: #363636;padding: 10px;border-radius: 5px;color: white">ویرایش ماشین ها</a>
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
                            <th class="editeTables">نام ماشین</th>
                            <th class="editeTables">دسته بندی</th>
                            <th class="editeTables">عملیات</th>
                        </tr>
                        @foreach ($carTypes as $CarType)
                            <tr>
                                @if($CarType->id==1)
                                    @continue
                                @endif
                                <td class="editeTables">{{$loop->index+1}}</td>
                                <td>{{$CarType->id}}</td>
                                <td>{{$CarType->name}}</td>
                                <td>{{$CarType->companyName}}</td>
                                <td>
                                    <div class="col-6">
                                        <a href="/admin/deleteCarType/{{$CarType->id}}"> <img src="/logo/delete.png" width="15" height="15"></a>
                                    </div>
                                    <div class="col-6">
                                        <a href="/admin/editCarType/{{$CarType->id}}"> <img src="/logo/pen.png" width="15" height="15"></a>
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
