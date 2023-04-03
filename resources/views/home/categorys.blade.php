@foreach ($categorys as $category)
    @if(collect($categoryExist)->contains('category_id', $category->id)&&$category->id!=1)
        <div class="col-12 divAllProduct">
            <div class="col-12 divTitleBestSeller">
                <p class="titleBestSeller">
                    {{$category->name}}
                </p>
            </div>
            @php
                $count=0;
            @endphp
            @foreach($products as $product)
                @if($product->category_id==$category->id)
                    @php
                        $count++
                    @endphp
                    @if($count==6)
                        @break
                    @endif

                    <div class="col-2 products">
                        <a href="/productDetails/{{$product->id}}" style="color: black">
                            <div class="col-12 center">
                                <img class="imageProduct " src="products/{{$product->id}}/1.png">
                            </div>
                            <div class="col-12" style="text-align: center">
                                <p>{{$product->name}}</p>
                                <p style="direction: rtl"> {{number_format($product->price)}} تومان</p>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
@endforeach
