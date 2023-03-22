<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/styleLogos.css" rel="stylesheet">
    <link href="/css/styleNavBar.css" rel="stylesheet">
    <link href="/css/slideShow.css" rel="stylesheet">
    <link href="/css/RWD.css" rel="stylesheet">
    <link href="/css/messages.css" rel="stylesheet">
    <link href="/css/adminPanel.css" rel="stylesheet">
    <link href="/css/adminPanel.css" rel="java">
</head>
<body style="background-color: #eeeeee">

<div class="sidenav">
    <div style="background-color: #363636;padding: 0px;margin:auto;height: 50px">
        <a href="/admin" style="font-size: 25px;margin: auto;padding-top: 10px;padding-right: 10px;color: white">منو</a>
    </div>

    <div class="col-12" style="background-color: #fed000;padding: 0px;margin:auto;height: 50px;width: 100%">
        <div class="col-9" >
            <p style="font-size: larger;margin: auto;padding-top: 10px;padding-right: 10px">مدیریت سایت</p>
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
</div>

@yield('content')

<script src="/js/adminPanel.js"></script>
</body>
</html>
