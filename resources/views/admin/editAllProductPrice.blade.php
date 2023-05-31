@extends('admin.menu')
@section('content')
    <div class="main">
        <div class="col-12" style="text-align: center;padding-top: 15px;">
            <a style="background-color: #363636;padding: 10px;border-radius: 5px;color: white">ویرایش کلی قیمت ها</a>
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

            <form method="post" name="enter" enctype="multipart/form-data" action="/admin/editAllProductPrice">
                @csrf
                <div class="col-12" style="text-align: center;padding-top: 40px">
                    <label style="background-color: #de1717;padding: 10px;border-radius: 10px;color: white"> تغییرات
                        قیمت برروی تمامی محصولات اعمال خواهد شد!!</label>
                </div>
                <div class="col-12 titleTextInput" style="display: flex;justify-content: center;padding-top: 50px">
                    <div class="col-4">
                        <input name="price" style="text-align: center" class="inputText"
                               placeholder="قیمت (درصد/ تومان)">
                    </div>
                </div>
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-6" style="text-align: center">
                        <label>قیمت ها بر حسب</label>
                        <select class="inputText" style="background-color: white" name="percentOrToman" id="cars">
                                <option value="percent">درصد</option>
                                <option value="toman">تومان</option>
                        </select>
                    </div>
                </div>
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-6" style="text-align: center">
                        <label>کاهش/ افزایش</label>
                        <select class="inputText" style="background-color: white" name="reduceOrIncrease" id="cars">
                            <option value="reduce">کاهش</option>
                            <option value="increase">افزایش</option>
                        </select>
                    </div>
                </div>
                <div class="col-12" style="padding-top: 50px;display: flex;justify-content: center">
                    <div class="col-3">
                        <input class="inputSubmit" type="submit" value="افزودن">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
