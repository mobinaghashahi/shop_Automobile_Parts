<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="/css/style.css?v=1.4" rel="stylesheet">
    <link href="/css/styleLogos.css?v=1.2" rel="stylesheet">
    <link href="/css/styleNavBar.css?v=1.2" rel="stylesheet">
    <link href="/css/slideShow.css?v=1.2" rel="stylesheet">
    <link href="/css/RWD.css?v=1.2" rel="stylesheet">
    <link href="/css/messages.css?v=1.2" rel="stylesheet">
    <link href="/css/adminPanel.css?v=1.2" rel="stylesheet">
    <link href="/css/adminPanel.css?v=1.2" rel="java">
</head>
<body style="background-color: #eeeeee">

<div class="sidenav">
    <div style="background-color: #363636;padding: 0px;text-align: center">
        <a href="/" style="font-size: 25px;margin: auto;color: white;text-align: center">مشاهده وبسایت</a>
    </div>
    <div class="col-12" style="background-color: #fed000;padding: 0px;margin:auto;height: 50px;width: 100%">
        <div class="col-9">
            <a href="/admin" style="font-size: 25px;margin: auto;padding-top: 10px;padding-right: 10px;color: #ffffff">مدیریت
                سایت</a>
        </div>
        <div class="col-3" style="padding-top: 15px">
            <img src="/logo/adminPanel.png" width="30" height="20">
        </div>
    </div>

    <button class="dropdown-btn">مدیریت محصولات
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="/admin/addProduct">افزودن محصول جدید</a>
        <a href="/admin/editProductPanel">ویرایش محصولات</a>
        <a href="/admin/editAllProductPrice">ویرایش کلی قیمت ها</a>
    </div>
    <button class="dropdown-btn">مدیریت برندها
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="/admin/addBrand">افزودن برند جدید</a>
        <a href="/admin/editBrandPanel">ویرایش برندها</a>
    </div>
    <button class="dropdown-btn">مدیریت ماشین ها
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="/admin/addCarType">افزودن ماشین جدید</a>
        <a href="/admin/editCarTypePanel">ویراش ماشین ها</a>
    </div>
    <button class="dropdown-btn">مدیریت تخفیف ها
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="/admin/addOff">افزودن تخفیف جدید</a>
        <a href="/admin/editOffPanel">ویرایش تخفیف</a>
    </div>
    <button class="dropdown-btn">مدیریت دسته بندی ها
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="/admin/addCategory">افزودن دسته بندی جدید</a>
        <a href="/admin/editCategoryPanel">ویرایش دسته بندی ها</a>
    </div>
    <button class="dropdown-btn">مدیریت رنگ ها
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="/admin/addColorShow">افزودن رنگ جدید</a>
        <a href="/admin/editColorShowPanel">ویرایش رنگ ها</a>
    </div>
    <button class="dropdown-btn">مدیریت اسلاید ها
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="/admin/addSlideShow">افزودن اسلاید جدید</a>
        <a href="/admin/editSlideShowPanel">ویرایش اسلاید ها</a>
    </div>
    <hr>
    <a href="/admin/showMessages">
        <div>
            <div class="circle" style="width: 10px;height: 10px;-webkit-border-radius: 25px;-moz-border-radius: 25px;
    border-radius: 25px;background: #ef6a11;border: 1px solid #000000;color: white;text-align: center;position: absolute;font-size: 8px">{{countNewMessages()}}</div>
            @if(countNewMessages()==0)
                <img width="25" height="25" style="position: absolute;z-index: -1" src="/logo/messageEmpty.png" alt="location"
                     data-v-b13dc018="">
            @else
                <img width="25" height="25" style="position: absolute;z-index: -1" src="/logo/messageExist.png" alt="location"
                     data-v-b13dc018="">
            @endif
            <a href="/admin/showMessages" style="position: relative;right: 28px;top: 0px">پیام ها</a>
        </div>
    </a>
</div>

@yield('content')
<script src="/js/canvasjs.min.js"></script>
<script src="/js/adminPanel.min.js"></script>

</body>
</html>
