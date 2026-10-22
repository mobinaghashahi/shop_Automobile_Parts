<div class="col-12 footer" style="color: white;direction: rtl;text-align: right;">
    <div class="col-3">
        <div class="contentFooter">
            <p>اطلاعات تماس</p>
            <p><a style="text-decoration: none;color: white" href="tel:09129231997">تماس:<br>09129231997</a></p>
            <p>
                <a href="https://wa.me/989129231997" target="_blank" rel="noopener noreferrer"
                   style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none; color: white;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                         fill="#25D366" aria-hidden="true" focusable="false" style="flex-shrink: 0;">
                        <path d="M20.52 3.48A11.91 11.91 0 0 0 12.04 0C5.43 0 .05 5.38.05 11.99c0 2.11.55 4.17 1.6 5.99L0 24l6.16-1.62a11.98 11.98 0 0 0 5.88 1.5h.01C18.66 23.88 24 18.5 24 11.89c0-3.2-1.24-6.2-3.48-8.41ZM12.05 21.86a9.94 9.94 0 0 1-5.07-1.39l-.36-.21-3.66.96.98-3.57-.24-.37a9.93 9.93 0 0 1-1.53-5.29c0-5.5 4.48-9.98 9.99-9.98a9.9 9.9 0 0 1 7.05 2.93 9.9 9.9 0 0 1 2.92 7.06c0 5.5-4.48 9.86-10.08 9.86Zm5.48-7.44c-.3-.15-1.77-.87-2.04-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.65.07-.3-.15-1.26-.46-2.4-1.48-.89-.79-1.49-1.77-1.66-2.07-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.03-.52-.07-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.8.37-.27.3-1.04 1.02-1.04 2.49s1.07 2.89 1.22 3.09c.15.2 2.1 3.2 5.09 4.49.71.3 1.27.49 1.7.62.71.22 1.36.19 1.87.11.57-.09 1.77-.72 2.02-1.42.25-.7.25-1.3.17-1.42-.07-.13-.27-.2-.57-.35Z"/>
                    </svg>
                    <span>واتس‌اپ: <bdi dir="ltr">09129231997</bdi></span>
                </a>
            </p>
            <p>آدرس:<br>آذربایجان غربی، تکاب بلوار نسرین‌پور، روبه روی دانشگاه پیام نور، خیابان شهيد قاضیان، یدکی غرب</p>
        </div>
    </div>
    <div class="col-3">
        <div class="contentFooter" >
            <p><a href="/aboutUs" style="text-decoration: none;color: white">درباره ما</a></p>
            <p><a href="/contact" style="text-decoration: none;color: white">تماس با ما</a></p>
        </div>
    </div>

    <div class="col-3">
        <div class="contentFooter" style="margin-top: 20px">
            <p>فروشگاه غرب یدک</p>
            <a href="https://balad.ir/location?latitude=36.385497&longitude=47.131602&zoom=16.500000"
               target="_blank"
               rel="noopener noreferrer">
                <img src="/logo/map.png?v=1" width="250" height="200">
            </a>
        </div>
    </div>

    <div class="col-3">
        <div class="contentFooter" style="margin-top: 20px">
            <p>نماد و استاندارد ها</p>
            <a referrerpolicy="origin" target="_blank" href="https://trustseal.enamad.ir/?id=7848082&Code=E7ooZowlFfkX79zqKvMAfXP2N0wKPcWI">
                <img
                    referrerpolicy="origin"
                    src="https://trustseal.enamad.ir/logo.aspx?id=7848082&Code=E7ooZowlFfkX79zqKvMAfXP2N0wKPcWI"
                    alt="نماد اعتماد الکترونیکی"
                    style="width: 80px; cursor: pointer;"
                />
            </a>
            <script src="https://www.zarinpal.com/webservice/TrustCode" type="text/javascript"></script>
        </div>
    </div>
</div>

<script src="/js/slideShow.min.js"></script>
<script src="/js/userPanel.min.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="/js/owl.carousel.js"></script>
<script>
    let owl = $('.owl-carousel');
    $('.owl-carousel').owlCarousel({
        items:6,
        margin:10,
        autoHeight:true,
        responsiveClass:true,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1,
                nav:true,
                loop:true
            },
            600:{
                items:3,
                nav:false,
                loop:true
            },
            1000:{
                items:6,
                nav:true,
                loop:true
            }
        }
    });
    $('.play').on('click',function(){
        owl.trigger('play.owl.autoplay',[1000])
    })
    $('.stop').on('click',function(){
        owl.trigger('stop.owl.autoplay')
    })




//اسکریپت های مربوط به انتخاب شهرستان و استان
    $('#city').change(function () {
        var city = $(this).find('option:selected').text();
    })

    $('#state').change(function () {
        var id = $(this).find('option:selected').val();
        $.ajax({
            method:'get',
            url:'/cities/'+id,
            success:function(msg) {
                $('#city').html(msg);
            }
        })
    });
    $(document).ready(function() {
        var id = $(this).find('option:selected').val();
        $.ajax({
            method:'get',
            url:'/cities/'+id,
            success:function(msg) {
                $('#city').html(msg);
            }
        })
    });
</script>

</body>
</html>
