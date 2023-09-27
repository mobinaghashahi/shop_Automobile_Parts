@extends('admin.menu')
@section('content')
    <div class="main">
        <div class="col-12" style="text-align: center;padding-top: 15px;">
            <a style="background-color: #363636;padding: 10px;border-radius: 5px;color: white">ویرایش</a>
        </div>
        <div class="blockOfInputs">
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

            <form method="post" name="enter" enctype="multipart/form-data" action="/admin/editColor">
                @csrf
                <input name="id" value="{{$color->id}}" style="display:none;text-align: center" class="inputText">
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-3">
                        <input name="name" style="text-align: center" value="{{$color->name}}" class="inputText" placeholder="نام رنگ">
                    </div>
                </div>
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <input name="hexColorCode" type="color" id="colorpicker" value="{{$color->hexColorCode}}">
                </div>
                <div class="col-12" style="padding-top: 10px;display: flex;justify-content: center">
                    <div class="col-3">
                        <input class="inputSubmit" type="submit" value="ویرایش">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
