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
        <div class="contentFooter" style="margin-top: 20px;">
            <p>فروشگاه یدکی اصلی</p>

            <div style="
            width: 100%;
            max-width: 300px;
            height: 200px;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
        ">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3843.5113131381368!2d47.1312643!3d36.385292!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4002bb000e72774d%3A0x1620d798f3eccebf!2z2YXbjNmG24wg2YXYp9ix2qnYqiDYotmC2Kcg2LXYp9iv2YI!5e1!3m2!1sen!2s!4v1792054846477!5m2!1sen!2s"
                    width="100%"
                    height="100%"
                    style="border: 0; display: block;"
                    allowfullscreen
                    loading="lazy"
                    referrerpolicy="strict-origin-when-cross-origin">
                </iframe>
            </div>
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
