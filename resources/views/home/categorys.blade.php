@foreach ($categorys as $category)
    @if(collect($categoryExist)->contains('category_id', $category->id)&&$category->id!=1)
        <div class="col-12 divAllProduct">
            <div class="col-12 divTitleBestSeller">
                <h2 class="titleBestSeller">
                    {{$category->name}}
                </h2>
            </div>
            @php
                $count=0;
            @endphp
            <div class="owl-carousel owl-theme">
            @foreach($products as $product)
                @if($product->category_id==$category->id)
                    @php
                        $count++
                    @endphp
                    @if($count==20)
                        @break
                    @endif
                        <a href="/productDetails/{{$product->id}}" style="color:black"><div class="col-12">
                                <div class="col-12 center">
                                    <img class="imageProduct" src="products/{{$product->id}}/1.png" alt="{{$product->name}}">
                                </div>
                                <div>
                                    <p style="text-align: center">{{$product->name}}</p>
                                </div>
                                <div>
                                    <p style="text-align: center;direction: rtl"><b>{{number_format($product->price)}}</b>  تومان</p>
                                </div>
                            </div></a>
                @endif
            @endforeach
        </div>
    @endif
@endforeach
