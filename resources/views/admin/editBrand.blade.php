@extends('admin.menu')
@section('content')
    <div class="main">
        <div class="col-12" style="text-align: center;padding-top: 15px;">
            <a style="background-color: #363636;padding: 10px;border-radius: 5px;color: white">ویرایش برند</a>
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

            <form method="post" name="enter" enctype="multipart/form-data" action="/admin/editBrand">
                @csrf
                <div class="col-12">
                    <div class="col-12 center" style="padding-top: 40px">
                        <img
                            style="width: 10%;height: 10%" src="/brand/{{$brand[0]->id}}/1.png"
                        " alt="برند {{$brand[0]->brandName}}"/>
                    </div>
                </div>
                <input name="id" value="{{$brand[0]->id}}" style="text-align: center;display: none" class="inputText"
                       placeholder="نام برند">
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-5">
                        <input name="name" value="{{$brand[0]->brandName}}" style="text-align: center" class="inputText"
                               placeholder="نام برند">
                    </div>
                </div>
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-5" style="text-align: center">
                        <label>تخفیف</label>
                        <select class="inputText" style="background-color: white" name="off_id" id="cars">
                            <option value="{{$brand[0]->offID}}">{{$brand[0]->offName}}</option>
                            @foreach ($offs as $index => $off)
                                @if($off->id != $brand[0]->offID)
                                    <option value="{{$off->id}}">{{$off->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-4" style="text-align: center">
                        <input id="file" type="file" class="form-control @error('file') is-invalid @enderror"
                               name="file">
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
