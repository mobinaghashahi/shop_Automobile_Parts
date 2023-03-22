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
                        <div class="col-12" style="justify-content: center;display: flex">
                            <div class="col-3">
                                <div class="successMessage" style="margin-top: 25px;margin-bottom: 20px">
                                    {!! \Session::get('msg') !!}
                                </div>
                            </div>
                        </div>

                    @endif
                    <table>
                        <tr>
                            <th>کد</th>
                            <th>نام ماشین</th>
                            <th>دسته بندی</th>
                            <th>عملیات</th>
                        </tr>
                        @foreach ($carTypes as $CarType)
                            <tr>
                                @if($CarType->id==1)
                                    @continue
                                @endif
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
