@extends('admin.menu')
@section('content')
    <div class="main">
        <div class="col-12" style="text-align: center;padding-top: 15px;">
            <a style="background-color: #363636;padding: 10px;border-radius: 5px;color: white">افزودن رنگ جدید جدید</a>
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

            <form method="post" name="enter" enctype="multipart/form-data" action="/admin/addColorProduct">
                @csrf
                <div class="col-12 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-3" style="display: none">
                        <input name="product_id" style="text-align: center" class="inputText" value="{{$productId}}">
                    </div>
                    <div class="col-3">
                        <input name="differentPrice" style="text-align: center" class="inputText"
                               placeholder="اختلاف قیمت با قیمت پایه">
                    </div>
                </div>
                <div class="col-12 titleTextInput" style="display: flex;justify-content: center">
                    <select style="display: none" name="color_id" id="color_id">
                        @foreach($colors as $color)
                            @if($color->id==1)
                                <option value=""></option>
                            @else
                                <option value="{{$color->id}}">{{$color->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    @foreach($colors as $color)
                        @if($color->id!=1)
                            <div class="selectOption" id="options" data-id="{{$color->id}}"
                                 style="border: 2px solid;padding: 4px 12px;line-height: 1.6;border-radius: 14px;color: #888888;display: block;float: right;margin: 5px;">
                                <a id="{{$color['id']}}" style='height: 25px;width: 25px;background-color: {{$color['hexColorCode']}};border-radius: 50%;display: block;float: right; '></a><span
                                    style="padding: 5px">{{$color['name']}}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="col-12" style="padding-top: 10px;display: flex;justify-content: center">
                    <div class="col-3">
                        <input class="inputSubmit" type="submit" value="افزودن">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#options*").click(function () {
                $("#options*").removeClass('selected');
                $("#options*").css('border','2px solid');

                $("#color_id").val($(this).attr("data-id"))
                $(this).css('border','2px solid #911d00');
                $(this).addClass('selected');
            });

        });
    </script>
@endsection
