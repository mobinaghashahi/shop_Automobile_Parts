<div  class="col-3" id="myDIV" style="margin-top: 10px;padding-left: 10px">
    <div class="col-12" style="text-align: center;border-bottom: 2px solid #b3b3b3;padding-bottom: 10px;border-inline-end: 1px solid gray;">
        <a style="text-align: center">حساب کاربری {{Auth::user()->nameAndFamily}}</a>
    </div>
    <div class="col-12" style="padding-top: 10px;text-align: center">
        <a id="dashboard" href="/user/dashboard" class="button" style="display: block;">
            پیشخوان
        </a>
    </div>
    <div class="col-12" style="text-align: center">
        <a href="/user/profile" id="profile" class="button" style="display: block;">
            مشخصات
        </a>
    </div>
    <div class="col-12" style="text-align: center">
        <a href="/user/orders"  id="orders" class="button" style="display: block;">
            سفارش ها
        </a>
    </div>
    <div class="col-12" style="text-align: center">
        <a href="/logout" class="button exit" style="display: block;">
            خروج
        </a>
    </div>
</div>
