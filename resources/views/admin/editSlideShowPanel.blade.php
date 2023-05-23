@extends('admin.menu')
@section('content')
    <div class="main">
        <div class="col-12" style="text-align: center;padding-top: 15px;">
            <a style="background-color: #363636;padding: 10px;border-radius: 5px;color: white">ویرایش اسلایدشو ها</a>
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
                    <div class="col-12" style="display:flex;justify-content: center;flex-wrap: wrap;">
                        @foreach($slideShows as $slideShow)
                            <div class="col-3" style="border: 1px solid black; padding: 10px;margin: 10px;border-radius: 10px">
                                <div class="col-12" style="display: flex;justify-content: center">
                                    <img src="/slideshow/{{$slideShow->name}}" width="100%">
                                </div>
                                <div class="col-12" style="padding-top: 10px">
                                    <div class="col-6" style="display: flex;justify-content: left">
                                        <a href="/admin/deleteSlideShow/{{$slideShow->id}}">
                                            <img src="/logo/deleteRed.png" width="20" height="20">
                                        </a>
                                    </div>
                                    <div class="col-6" style="display: flex;justify-content: right">
                                        <a href="/admin/editSlideShow/{{$slideShow->id}}">
                                            <img src="/logo/pen.png" width="20" height="20">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
