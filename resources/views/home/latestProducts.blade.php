
<div class="col-12 divAllProduct">
    <div class="col-12 divTitleBestSeller">
        <h2 class="titleBestSeller">
            جدید ترین محصولات
        </h2>
    </div>
    @php
        $count=0;
    @endphp
    <div class="owl-carousel owl-theme">
        @foreach($products as $product)
                <a href="/productDetails/{{$product->id}}" style="color:black"><div class="col-12">
                        <div class="col-12 center">
                            <img class="imageProduct " src="products/{{$product->id}}/{{$product->imageName}}" alt="{{$product->name}}">
                        </div>
                        <div>
                            <p style="text-align: center">{{$product->name}}</p>
                        </div>
                        <div>
                            <p style="text-align: center;direction: rtl"><b>{{number_format($product->price)}}</b>  تومان</p>
                        </div>
                    </div></a>
            @if($count==15)
                @break
            @endif
            @php
                $count++;
            @endphp
        @endforeach
    </div>
</div>
