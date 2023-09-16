<div class="col-12 divAllProduct">
    <div class="col-12 divTitleBestSeller">
        <h2 class="titleBestSeller">
            محصولات مرتبط
        </h2>
    </div>
    @php
        $count=0;
    @endphp
    <div class="owl-carousel owl-theme">
        @foreach($products as $product)
                <a href="/productDetails/{{$product->id}}" style="color:black"><div class="col-12">
                        @if (File::exists('products/'.$product->id.'/'.$product->imageName))
                            <div class="col-12 center">
                                <img class="imageProduct" src="/products/{{$product->id}}/{{$product->imageName}}" alt="{{$product->name}}">
                            </div>
                        @else
                            <div class="col-12 center">
                                <img class="imageProduct" src="/logo/notFound.png" alt="{{$product->name}}">
                            </div>
                        @endif
                        <div>
                            <p style="text-align: center">{{$product->name}}</p>
                        </div>
                        <div>
                            <p class="showPriceInBlock"><b>{{number_format($product->price)}}</b>  تومان</p>
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
