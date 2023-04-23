@extends('admin.menu')
@section('content')
    <div class="main">
        <div class="col-12" style="text-align: center;padding-top: 15px;">
            <a style="background-color: #363636;padding: 10px;border-radius: 5px;color: white">افزودن محصول جدید</a>
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

            <form method="post" name="enter" enctype="multipart/form-data" action="/admin/addProduct">
                @csrf
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-4">
                        <input name="name" style="text-align: center" class="inputText" placeholder="نام محصول">
                    </div>
                </div>
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-4">
                        <input name="price" style="text-align: center" class="inputText" placeholder="قیمت">
                    </div>
                </div>
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-4">
                        <input name="count" style="text-align: center" class="inputText" placeholder="تعداد">
                    </div>
                </div>
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-4">
                        <textarea name="description" class="inputText" style="text-align: center"
                                  placeholder="توضیحات"></textarea>
                    </div>
                </div>
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-4" style="text-align: center">
                        <label>برند</label>
                        <select class="inputText" style="background-color: white" name="brand_id" id="cars">
                            @foreach ($brand as $index => $brandRows)
                                <option value="{{$brandRows->id}}">{{$brandRows->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-4" style="text-align: center">
                        <label>نوع ماشین</label>
                        <select class="inputText" style="background-color: white" name="carType_id" id="cars">
                            @foreach ($carType as $index => $carTypeRows)
                                <option value="{{$carTypeRows->id}}">{{$carTypeRows->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-4" style="text-align: center">
                        <label>تخفیف</label>
                        <select class="inputText" style="background-color: white" name="off_id" id="cars">
                            @foreach ($off as $index => $offRows)
                                <option value="{{$offRows->id}}">{{$offRows->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-4" style="text-align: center">
                        <label>دسته بندی</label>
                        <select class="inputText" style="background-color: white" name="category_id" id="cars">
                            @foreach ($category as $index => $categoryRows)
                                <option value="{{$categoryRows->id}}">{{$categoryRows->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
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
                        <input class="inputSubmit" type="submit" value="افزودن">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
