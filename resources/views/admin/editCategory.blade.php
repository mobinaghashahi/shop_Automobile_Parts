@extends('admin.menu')
@section('content')
    <div class="main">
        <div class="col-12" style="text-align: center;padding-top: 15px;">
            <a style="background-color: #363636;padding: 10px;border-radius: 5px;color: white">ویرایش دسته بندی</a>
        </div>
        <div class="blockOfInputs">
            @if (\Session::has('msg'))
                <div class="col-12" style="justify-content: center;display: flex">
                    <div class="col-3">
                        <div class="successMessage" style="margin-top: 25px">
                            {!! \Session::get('msg') !!}
                        </div>
                    </div>
                </div>

            @endif
            @if ($errors->any())
                @foreach($errors->all() as $error)
                    <div class="col-12" style="justify-content: center;display: flex">
                        <div class="col-3">
                            <p style="color: #ffffff;text-align: center;background-color: #ff2e2e;direction:rtl;line-height: 15px;padding: 10px;border-radius: 10px">{{$error}}</p>
                        </div>
                    </div>
                @endforeach
            @endif

            <form method="post" name="enter" enctype="multipart/form-data" action="/admin/editCategory">
                @csrf
                <input name="id" value="{{$category[0]->id}}" style="display:none;text-align: center" class="inputText" placeholder="نام دسته بندی">
                <div class="col-12 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-3">
                        <input name="name" value="{{$category[0]->name}}" style="text-align: center" class="inputText" placeholder="نام دسته بندی">
                    </div>
                </div>
                <div class="col-12" style="padding-top: 10px;display: flex;justify-content: center">
                    <div class="col-3">
                        <input class="inputSubmit" type="submit" value="ویراش">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
