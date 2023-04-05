<div class="col-12 footer">
    <div class="col-12 divItemsFooter">
        <div class="col-3 divItemFooter">
            <div class="divTextItemsFooter">
                <a>ارسال به سرار ایران</a>
            </div>
            <div>
                <img src="/logo/truck.png" width="90" height="60" >
            </div>
        </div>
        <div class="col-3 divItemFooter">
            <div class="divTextItemsFooter">
                <a>تضمین کیفیت کالاها</a>
            </div>
            <div>
                <img src="/logo/star.png" width="60" height="60" >
            </div>
        </div>
        <div class="col-3 divItemFooter">
            <div class="divTextItemsFooter">
                <a>خرید امن</a>
            </div>
            <div>
                <img src="/logo/shild.png" width="50" height="60" >
            </div>
        </div>
        <div class="col-3 divItemFooter">
            <div class="divTextItemsFooter">
                <a>خرید آسان</a>
            </div>
            <div>
                <img src="/logo/easy.png" width="50" height="60" >
            </div>
        </div>
    </div>
</div>

<script src="/js/slideShow.js"></script>
<script src="/js/userPanel.js"></script>


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
                nav:true
            },
            600:{
                items:3,
                nav:false
            },
            1000:{
                items:6,
                nav:true,
                loop:false
            }
        }
    });
    $('.play').on('click',function(){
        owl.trigger('play.owl.autoplay',[1000])
    })
    $('.stop').on('click',function(){
        owl.trigger('stop.owl.autoplay')
    })
</script>

</body>
</html>
