@extends("layout.master")
<?php
use App\Models\Brand;
?>
@section('content')

    <--meta tags for use in TOROB-->
    <meta name="product_name" content="{{$product[0]->name}}">
    <meta name="product_price" content="{{$product[0]->price}}">
    <meta name="product_old_price" content="{{$product[0]->old_price}}">
    <meta name="availability" content="{{$product[0]->availability}}">
    <meta property="og:image" content="{{$product[0]->imageName}}">
    <--***********>
    <form method="post" name="enter" action="/cart/addToCart">
        @csrf
        <div class="col-12" style="padding: 10px 0px 10px 0px">
            <div style="text-align: right;direction: rtl">
                @if (\Session::has('msg'))
                    <div class="notification notificationSuccess">
                        <p>{!! \Session::get('msg') !!}</p>
                        <span class="notification_progress"></span>
                    </div>
                @endif
                @if ($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="notification notificationError">
                            <p>{{$error}}</p>
                            <span class="notification_progress"></span>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="col-7">
                @if (File::exists('products/'.$product[0]->id.'/'.$product[0]->imageName))
                    <div class="col-12 center">
                        <img class="imageProduct" src="/products/{{$product[0]->id}}/{{$product[0]->imageName}}" alt="{{$product[0]->name}}">
                    </div>
                @else
                    <div class="col-12 center">
                        <img class="imageProduct" style="width: 70%;height: 70%" src="/logo/notFound.png" alt="{{$product[0]->name}}">
                    </div>
                @endif
            </div>
            <div class="col-5">
                <div class="col-12" style="font-size: 30px">
                    <p style="text-align: right;font-weight: bolder">{{$product[0]->name}}</p>
                </div>
                <div class="col-12 productsDetailsText">
                    <p style="text-align: right"><b>برند:</b> {{$product[0]->brandName}}</p>
                    <p style="text-align: right"><b>قیمت تکی:</b> <b class="showPriceFont showPriceInBlock">{{number_format($product[0]->price)}}</b> تومان</p>
                    <p style="text-align: right;direction: rtl">برای اطلاع از قیمت عمده این محصول تماس حاصل نمایید.</p>
                    <p style="text-align: right;direction: rtl;word-wrap: break-word">{{$product[0]->description}}</p>
                    <input type="text" name="id" value="{{$product[0]->id}}" hidden>
                </div>
                <div class="col-4" style="float: right; display: flex;justify-content: center;padding-top: 20px">
                    <input type="button" value="-" class="minus">
                    <input type="number" value="1" min="1" max="{{stock($product[0]->id)}}" class="count" name="count" style="width: 10%;text-align: center;">
                    <input type="button" value="+" class="plus">
                </div>
                <div class="col-8" style="float: right; display: flex;justify-content: center;padding-top: 10px">
                    @if(isInStock($product[0]->id))
                        <input class="inputSubmit" type="submit" value="خرید" style="width: 80%">
                    @else
                        <input disabled class="inputAlert" type="submit" value="ناموجود" style="width: 70%">
                    @endif
                    @if(!empty(Auth::user()->userType)&&Auth::user()->hasRole(['admin', 'designer']))
                        <a class="inputSubmit" href="/admin/editProduct/{{$product[0]->id}}" style="width: 30%;margin-left:20px;box-shadow: 0px 0px 14px -7px #39b200;
                        background-image: linear-gradient(45deg, #187900 0%, #39b200 51%, #187900 100%);text-decoration: none">ویرایش</a>
                        @endif
                </div>

            </div>
        </div>
        @include('relatedProducts')
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    //این اسکریپت برای کم و زیاد کردن مقدار تعداد محصولی که میخواهیم خریداری کنیم استفاده میشود.
    <script>
        $(document).ready(function () {
            $("body").on('click', '.plus', function (e) {
                let value =$(".count").val()
                $(".count").val(+value+1)
            })
            $("body").on('click', '.minus', function (e) {
                let value =$(".count").val()
                if(value>1)
                    $(".count").val(+value-1)
            })
        })
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "Product",
      "name": "{{$product[0]->name}}",
      "image": "https://yadakasli.ir/products/{{$product[0]->id}}/{{$product[0]->imageName}}",
      "description": "{{$product[0]->description}}",
      "brand": {
        "@type": "Brand",
        "name": "{{$product[0]->brandName}}"
      },
      "offers": {
        "@type": "Offer",
        "url": "https://yadakasli.ir/productDetails/{{$product[0]->id}}",
        "priceCurrency": "IRR",
        "price": "{{$product[0]->price}}",
        "itemCondition": "https://schema.org/NewCondition",
        "availability": "https://schema.org/{{$product[0]->availability}}"
      }
    }
</script>

@endsection
