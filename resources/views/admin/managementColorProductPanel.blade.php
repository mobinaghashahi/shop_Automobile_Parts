@extends('admin.menu')
@section('content')

    <div class="main">
        <div class="col-12" style="text-align: center;padding-top: 15px;">
            <a style="background-color: #363636;padding: 10px;border-radius: 5px;color: white">محصولات دارای رنگ بندی</a>
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
                            <th class="editeTables">کد</th>
                            <th class="editeTables">نام محصول</th>
                            <th class="editeTables">رنگ های محصول</th>
                            <th class="editeTables">مدیریت رنگ</th>
                        </tr>
                        @foreach ($products as $product)
                            <tr>
                                <td class="editeTables">{{$loop->index+1}}</td>
                                <td>#{{$product['id']}}</td>
                                <td>{{$product['name']}}</td>
                                <td>
                                    @if($product['color']!=null)
                                        @foreach($product['color'] as $color)
                                            <span style="height: 25px;width: 25px;background-color: {{$color}};border-radius: 50%;display: inline-block;"></span>
                                        @endforeach
                                    @endif
                                </td>
                                <td>

                                    <div class="col-12">
                                        <a href="/admin/managementColorProduct/{{$product['id']}}"> <img src="/logo/management.png"
                                                                                              width="20"
                                                                                              height="20"></a>
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
