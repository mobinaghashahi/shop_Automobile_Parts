<!DOCTYPE html>
<html>
<head>

    <title>فروشگاه یدکی اصلی</title>
    <link rel="icon" type="image/x-icon" href="/logo/logo.png">


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/userPanel.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/styleLogos.css" rel="stylesheet">
    <link href="/css/styleNavBar.css" rel="stylesheet">
    <link href="/css/slideShow.css" rel="stylesheet">
    <link href="/css/RWD.css" rel="stylesheet">
    <link href="/css/messages.css" rel="stylesheet">

    <!--owl -->
    <link href="/css/owl.carousel.css" rel="stylesheet">
    <link href="/css/owl.theme.default.css" rel="stylesheet">

</head>
<body onload="activeBtn()">

<header>
    <div class="col-12 header">
        <a href="https://instagram.com/yadak.asli3113?igshid=YmMyMTA2M2Y=">
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
        <div class="col-9" style="width: 60%">
            <ul class="ulNavigator">
                <li class="dropdown"><a class="dropBtn level1">برندها</a>
                    <div class="dropdownContentLevel1">
                        @foreach($brands as $brand)
                            <a class="level2" href="/brands/{{$brand->id}}">{{$brand->name}} <img
                                    style="padding-left: 5px;" src="/brand/{{$brand->id}}/1.png"
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
                                <a class="level3" href="/carTypeCategorys/{{$car->id}}">{{$car->name}}</a>
                            @endforeach
                        </div>
                        <a class="level2" href="#">ایران خودرو<img style="padding-left: 5px;" src="/logo/irankhodro.png"
                                                                   width="20" height="25"></a>
                        <div class="dropdownContentLevel2">
                            @foreach($carsIranKhodro as $car)
                                <a class="level3" href="/carTypeCategorys/{{$car->id}}">{{$car->name}}</a>
                            @endforeach
                        </div>
                    </div>
                </li>
                <li><a class="level1" href="/aboutUs">درباره ما</a></li>
            </ul>
        </div>
        @if(session()->has('products'))
            <div class="cartTitle" style="float:left;padding-top: 10px;width: 30%;padding-left: 10px">
                <div>
                    <a href="/cart/showCart">
                        <div class="circle" style="text-align: center;position: absolute;left:40px;">{{countCart()}}</div>
                        <img src="/logo/cart.png" width="40" height="40">

                    </a>

                </div>

            </div>
        @endif
    </div>
</header>


