<!DOCTYPE html>
<html>
<head lang="fa">

    <title>فروشگاه یدکی اصلی</title>
    <link rel="shortcut icon" href="/logo/logo.ico">

    <meta name="title" content="فروشگاه لوازم یدکی باقری">
    <meta name="description" content="بورس انواع قطعات بدنه، جلوبندی، موتوری و برقی خودروهای ایرانی و خارجی بصورت عمده و تکی با برندهای معتبر.">
    <meta name="keywords" content="لوازم یدکی،ماشین،فروشگاه">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="fa">
    <meta name="author" content="محمد مبین آقاشاهی اردستانی">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/userPanel.css" rel="stylesheet">
    <link href="/css/style.css?v=3" rel="stylesheet">
    <link href="/css/styleLogos.css" rel="stylesheet">
    <link href="/css/styleNavBar.css?v=1.9" rel="stylesheet">
    <link href="/css/slideShow.css" rel="stylesheet">
    <link href="/css/RWD.css?v=3.1" rel="stylesheet">
    <link href="/css/messages.css" rel="stylesheet">

    <!--owl -->
    <link href="/css/owl.carousel.css" rel="stylesheet">
    <link href="/css/owl.theme.default.css" rel="stylesheet">

</head>
<body onload="activeBtn()">

<header>
    <div class="col-12 header">
        <a href="https://instagram.com/yadak.asli3113?igshid=YmMyMTA2M2Y=">
            <img class="logoInstagram" src="/logo/instagram.png" title="instagram" alt="instagram" width="25" height="25">
        </a>
    </div>
    <div class="col-12">
        <div>
            <a href="/">
                <img class="logo" title="فروشگاه لوازم یدکی باقری" alt="فروشگاه لوازم یدکی باقری" src="/logo/logo.png">
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
                <form method="get" action="/resultSearch" >
                    <div style="padding: 6px;display: inline;border-radius:0px 5px 10px 0px;background-color: #595959FF;">
                        <input class="submitSearch" type="submit" value='جست و جو'>
                    </div>
                    <div class="divInputSearch">
                        <input name="text" style="background-color: transparent;color: black;" class="inputSearch" type="text" placeholder="دنبال چی میگردی؟!">
                    </div>
                </form>
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
                                    height="25" alt="برند {{$brand->name}}"/></a>
                        @endforeach
                    </div>
                </li>
                <li class="dropdown">
                    <a class="dropBtn level1">محصولات</a>
                    <div class="dropdownContentLevel1">
                        <a class="level2" href="#">سایپا<img style="padding-left: 5px;" src="/logo/saypa.png" width="20"
                                                             height="20" alt="دسته بندی سایپا"></a>
                        <div class="dropdownContentLevel2">
                            @foreach($carsSaypa as $car)
                                <a class="level3" href="/carTypeCategorys/{{$car->id}}">{{$car->name}}</a>
                            @endforeach
                        </div>
                        <a class="level2" href="#">ایران خودرو<img style="padding-left: 5px;" src="/logo/irankhodro.png"
                                                                   width="20" height="25" alt="دسته بندی ایران خودرو"></a>
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
                        <img src="/logo/cart.png" width="30" height="30" alt="سبد خرید">

                    </a>

                </div>

            </div>
        @endif
    </div>
</header>


