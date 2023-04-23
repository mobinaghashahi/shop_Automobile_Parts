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

            <form method="post" name="enter" enctype="multipart/form-data" action="/admin/editProduct">
                @csrf
                <input name="id" value="{{$currentlyProduct[0]->id}}" style="text-align: center;display: none"
                       class="inputText" placeholder="نام محصول">
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-4">
                        <input name="name" value="{{$currentlyProduct[0]->name}}" style="text-align: center"
                               class="inputText" placeholder="نام محصول">
                    </div>
                </div>
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-4">
                        <input name="price" value="{{$currentlyProduct[0]->price}}" style="text-align: center"
                               class="inputText" placeholder="قیمت">
                    </div>
                </div>
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-4">
                        <input name="count" value="{{$currentlyProduct[0]->count}}" style="text-align: center"
                               class="inputText" placeholder="تعداد">
                    </div>
                </div>
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-4">
                        <textarea name="description" class="inputText" style="text-align: center"
                                  placeholder="توضیحات">{{$currentlyProduct[0]->description}}</textarea>
                    </div>
                </div>
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-4" style="text-align: center">
                        <label>برند</label>
                        <select class="inputText" style="background-color: white" name="brand_id" id="cars">
                            <option
                                value="{{$currentlyProduct[0]->brand_id}}">{{$currentlyProduct[0]->brandName}}</option>
                            @foreach ($brand as $index => $brandRows)
                                @if($currentlyProduct[0]->brand_id!=$brandRows->id)
                                    <option value="{{$brandRows->id}}">{{$brandRows->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-4" style="text-align: center">
                        <label>نوع ماشین</label>
                        <select class="inputText" style="background-color: white" name="carType_id" id="cars">
                            <option
                                value="{{$currentlyProduct[0]->carType_id}}">{{$currentlyProduct[0]->carTypeName}}</option>
                            @foreach ($carType as $index => $carTypeRows)
                                @if($currentlyProduct[0]->carType_id!=$carTypeRows->id)
                                    <option value="{{$carTypeRows->id}}">{{$carTypeRows->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-4" style="text-align: center">
                        <label>تخفیف</label>
                        <select class="inputText" style="background-color: white" name="off_id" id="cars">
                            <option value="{{$currentlyProduct[0]->off_id}}">{{$currentlyProduct[0]->offName}}</option>
                            @foreach ($off as $index => $offRows)
                                @if($currentlyProduct[0]->off_id!=$offRows->id)
                                    <option value="{{$offRows->id}}">{{$offRows->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6 titleTextInput" style="display: flex;justify-content: center">
                    <div class="col-4" style="text-align: center">
                        <label>دسته بندی</label>
                        <select class="inputText" style="background-color: white" name="category_id" id="cars">
                            <option
                                value="{{$currentlyProduct[0]->category_id}}">{{$currentlyProduct[0]->categoryName}}</option>
                            @foreach ($category as $index => $categoryRows)
                                @if($currentlyProduct[0]->category_id!=$categoryRows->id)
                                    <option value="{{$categoryRows->id}}">{{$categoryRows->name}}</option>
                                @endif
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
