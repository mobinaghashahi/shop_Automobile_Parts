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
            <a href="/productDetails/{{$product->id}}" style="color:black">
                <div class="col-12">
                    @if (File::exists('products/'.$product->id.'/'.$product->imageName))
                        <div class="col-12 center">
                            <img class="imageProduct" src="/products/{{$product->id}}/{{$product->imageName}}"
                                 alt="{{$product->name}}">
                        </div>
                    @else
                        <div class="col-12 center">
                            <img class="imageProduct" src="/logo/notFound.png" alt="{{$product->name}}">
                        </div>
                    @endif
                    <div>
                        <p style="text-align: center;font-size: 15px">{{$product->name}}</p>
                    </div>
                    <div>
                        <!-- چک کردن تخفیف محصول-->
                        @if(\App\Models\Off::where('brand_id','=',$product->brand_id)->first())
                            <s><p class="showPriceInBlock" style="line-height: 10px;color: gray"><b class="showPriceFont">{{number_format($product->price)}}</b>
                            تومان</p></s>
                        <p class="showPriceInBlock" style="line-height: 10px"><b class="showPriceFont">{{number_format(offCalculation(offPercentByBrandID($product->brand_id),$product->price))}}</b>
                            تومان</p>
                        @else
                            <p class="showPriceInBlock" style="line-height: 10px"><b class="showPriceFont">{{number_format($product->price)}}</b>
                                تومان</p>
                        @endif
                    </div>

                </div>
            </a>
            @if($count==15)
                @break
            @endif
            @php
                $count++;
            @endphp
        @endforeach
    </div>
</div>
