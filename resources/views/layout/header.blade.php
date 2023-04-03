<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/userPanel.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/styleLogos.css" rel="stylesheet">
    <link href="/css/styleNavBar.css" rel="stylesheet">
    <link href="/css/slideShow.css" rel="stylesheet">
    <link href="/css/RWD.css" rel="stylesheet">
    <link href="/css/messages.css" rel="stylesheet">

</head>
<body onload="activeBtn()">

<header>
    <div class="col-12 header">
        <a href="#">
            <img class="logoInstagram" src="/logo/instagram.png" width="25" height="25">
        </a>
    </div>
    <div class="col-12">
        <div>
            <a href="/">
                <img class="logo" src="/logo/logo.png">
            </a>
        </div>
        <div class="middleHeader">
            <div class="divUserName">
                @if(!Auth::check())
                    <a href="/login" style="text-decoration: none;color: black">ورود | ثبت نام</a>
                @else
                    <a href="/user/dashboard"
                       style="text-decoration: none;color: black">{{Auth::user()->nameAndFamily}}</a>
                @endif
            </div>
            <div class="divSearch">
                <input class="inputSearch" type="text" placeholder="جست و جو...">
            </div>
        </div>
    </div>
    <div class="col-12 header">
        <ul class="ulNavigator">
            <li class="dropdown"><a class="dropBtn level1">برندها</a>
                <div class="dropdownContentLevel1">
                    @foreach($brands as $brand)
                        <a class="level2" href="/brands/{{$brand->id}}">{{$brand->name}} <img style="padding-left: 5px;" src="/brand/{{$brand->id}}/1.png"
                                                                 width="25"
                                                                 height="25"/></a>
                    @endforeach
                </div>
            </li>
            <li class="dropdown">
                <a class="dropBtn level1">محصولات</a>
                <div class="dropdownContentLevel1">
                    <a class="level2" href="#">سایپا<img style="padding-left: 5px;" src="/logo/saypa.png" width="20"
                                                         height="20"></a>
                    <div class="dropdownContentLevel2">
                        @foreach($carsSaypa as $car)
                        <a class="level3" href="#">{{$car->name}}</a>
                        @endforeach
                    </div>
                    <a class="level2" href="#">ایران خودرو<img style="padding-left: 5px;" src="/logo/irankhodro.png"
                                                               width="20" height="25"></a>
                    <div class="dropdownContentLevel2">
                        @foreach($carsIranKhodro as $car)
                            <a class="level3" href="#">{{$car->name}}</a>
                        @endforeach
                    </div>
                </div>
            </li>
            <li><a class="level1" href="#home">درباره ما</a></li>
        </ul>
    </div>
</header>


