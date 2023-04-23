@extends('admin.menu')
@section('content')
    <div class="main">
        <div class="col-12" style="text-align: center;padding-top: 15px;">
            <a style="background-color: #363636;padding: 10px;border-radius: 5px;color: white">ویرایش دسته بندی</a>
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

            <form method="post" name="enter" enctype="multipart/form-data" action="/admin/editCategory">
                @csrf
                <input name="id" value="{{$category[0]->id}}" style="display:none;text-align: center" class="inputText" placeholder="نام دسته بندی">
                <div class="col-12 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-3">
                        <input name="name" value="{{$category[0]->name}}" style="text-align: center" class="inputText" placeholder="نام دسته بندی">
                    </div>
                </div>
                <div class="col-12 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-4" style="text-align: center">
                        <input id="file" type="file" class="form-control @error('file') is-invalid @enderror"
                               name="file">
                        @error('file')
                        <span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
                        @enderror
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
