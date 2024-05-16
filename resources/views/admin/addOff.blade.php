@extends('admin.menu')
@section('content')
    <div class="main">
        <div class="col-12" style="text-align: center;padding-top: 15px;">
            <a style="background-color: #363636;padding: 10px;border-radius: 5px;color: white">افزودن تخفیف جدید</a>
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

            <form method="post" name="enter" enctype="multipart/form-data" action="/admin/addOff">
                @csrf
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-6">
                        <input name="name" style="text-align: center" class="inputText" placeholder="نام تخفیف">
                    </div>
                </div>
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-6">
                        <input name="percent" style="text-align: center" class="inputText" placeholder="درصد تخفیف">
                    </div>
                </div>
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-6" style="text-align: center">
                        <label>برند</label>
                        <select class="inputText" style="background-color: white" name="brand_id" id="cars">
                            @foreach ($brand as $index => $brandRows)
                                <option value="{{$brandRows->id}}">{{$brandRows->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12" style="padding-top: 10px;display: flex;justify-content: center">
                    <div class="col-3">
                        <input class="inputSubmit" type="submit" value="افزودن">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
