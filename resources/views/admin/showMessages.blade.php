@extends('admin.menu')
@section('content')
    <div class="main">
        <div class="col-12" style="text-align: center;padding-top: 15px;">
            <a style="background-color: #363636;padding: 10px;border-radius: 5px;color: white">پیام ها</a>
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
                            <th>کد</th>
                            <th>نام</th>
                            <th>موضوع</th>
                            <th>شماره تماس</th>
                            <th>ایمیل</th>
                            <th>توضیحات</th>
                            <th>عملیات</th>
                        </tr>
                        @foreach ($messages as $message)

                            <tr @if($message->state==0) style="background-color: #e2e8f0;font-weight: bolder" @else style="background-color: #9a9a9a;" @endif>
                                <td>{{$message->id}}</td>
                                <td>{{$message->name}}</td>
                                <td>{{$message->title}}</td>
                                <td>{{$message->phoneNumber}}</td>
                                <td>{{$message->email}}</td>
                                <td>{{$message->description}}</td>
                                <td>
                                    <div class="col-12">
                                        <a href="/admin/seenMessage/{{$message->id}}"> <img alt="دیده شدن" @if($message->state==0) src="/logo/closeEye.png" @else src="/logo/openEye.png" @endif width="15" height="15"></a>
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
