@extends('layout.master')

@section('content')
<div class="col-12" style="background-image: url('/logo/background.jpg')">
    <div class="col-12">
        <p style="direction: rtl;text-align: right;padding: 40px 40px 0px 40px;font-weight: bolder;font-size: 40px;margin: 0px">تماس با <span style="color: #ed6b13">یدکی اصلی</span></p>
        <p class="textContact">کاربر گرامی یدکی اصلی؛ باعث افتخار ماست تا نظرات خود را با ما از طریق این فرم به اشتراک بگذارید.
            جهت اعلام شکایت، نظر، انتقاد و پیشنهاد در مورد سرویس‌دهی وب‌سایت یدکی اصلی می‌توانید با شماره تلفن ۰۹۱۲۹۲۳۱۹۹۷ تماس بگیرید یا از طریق فرم زیر موضوع موردنظر را با ما در میان بگذارید. </p>
    </div>
    <div class="col-12">
        <div class="col-6 contactRightSide" >
            <div class="col-6">
                <div class="col-10 divLabelInput">
                    <a>نام و نام خانوادگی</a>
                    <input name="phoneNumber" type="text" class="inputText" style="border-radius: 5px;">
                </div>
            </div>
            <div class="col-6">
                <div class="col-10 divLabelInput">
                    <a>موضوع</a>
                    <input name="phoneNumber" type="text" class="inputText" style="border-radius: 5px;">
                </div>
            </div>
            <div class="col-6">
                <div class="col-10 divLabelInput">
                    <a>ایمیل</a>
                    <input name="phoneNumber" type="email" class="inputText" style="border-radius: 5px;">
                </div>
            </div>
            <div class="col-6">
                <div class="col-10 divLabelInput">
                    <a>تلفن تماس</a>
                    <input name="phoneNumber" type="text" class="inputText" style="border-radius: 5px;">
                </div>
            </div>
            <div class="col-12">
                <div class="col-11 divLabelInput">
                    <a>توضیحات</a>
                    <textarea class="inputTextArea"></textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="col-4 divLabelInput">
                    <input name="enter" class="inputSubmit inputSubmitContact" type="submit" value="ارسال فرم">
                </div>
            </div>

        </div>
        <div class="col-4 contactLeftSide" >
            <div class="col-12" style="display: flex;float: right;justify-content: right">
                <div style="padding-right: 5px;line-height: 5px;font-size: 12px">
                    <p style="font-weight: bolder;line-height: 20px">:راه های ارتباطی</p>
                    <a style="text-decoration: none;color: black" href="tel:09129231997"><p>۰۹۱۲۹۲۳۱۹۹۷</p></a>
                    <a style="text-decoration: none;color: black"  href="tel:09129366202"><p>۰۹۱۲۹۳۶۶۲۰۲</p></a>
                </div>
                <img src="/logo/phone.svg" alt="location" data-v-b13dc018="">
            </div>
            <div class="col-12" style="display: flex;float: right;justify-content: right">
                <div style="padding-right: 5px;line-height: 5px;font-size: 12px">
                    <p style="font-weight: bolder;line-height: 20px">:ایمیل</p>
                    <p>Danyel.bagheri3113@gmail.com</p>
                </div>
                <img src="/logo/email.svg" alt="location" data-v-b13dc018="">
            </div>
            <div class="col-12" style="display: flex;float: right;justify-content: right">
                <div style="padding-right: 5px;line-height: 5px;font-size: 12px">
                    <p style="font-weight: bolder;line-height: 20px">:دفتر مرکزی قزوین</p>
                    <p>قزوین، بلوار نوروزیان، روبروی بانک ملت، بین البرز ۳۹ و ۴۱ </p>
                </div>
                <img src="/logo/location.svg" alt="location" data-v-b13dc018="">
            </div>

        </div>
    </div>
</div>
@endsection
