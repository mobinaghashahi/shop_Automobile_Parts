<div class="col-12 footer" style="color: white;direction: rtl;text-align: right;">
    <div class="col-3">
        <div class="contentFooter">
            <p>اطلاعات تماس</p>
            <p><a style="text-decoration: none;color: white" href="tel:09129231997">تماس:<br> 09129231997</a></p>
            <p>ایمیل: yadakasli3113@gmail.com</p>
            <p>آدرس:<br>تهران،اسلامشهر، بلوار گلها، بین البرز ۳۹ و ۴۱</p>
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
            <p>فروشگاه یدکی اصلی</p>
            <a href="https://goo.gl/maps/YDG6HAuJmft51ohi8">
                <img src="/logo/map.png?v=1" width="250" height="200">
            </a>
        </div>
    </div>
    <div class="col-3">
        <div class="contentFooter" style="margin-top: 20px">
            <p>نماد و استاندارد ها</p>
            <a href="https://trustseal.enamad.ir/?id=337118&amp;Code=MqbcszGUlIijqFHhUu7l" target="_blank" rel="noopener">
                <img style="width: 80px" src="/logo/enamad.png" />
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
