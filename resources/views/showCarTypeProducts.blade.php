@extends('layout.master')
@section('content')

    <div class="col-12 divAllProduct">
        @forelse($products as $product)
            <div class="col-3 products">
                <a href="/productDetails/{{$product->id}}" style="color: black">
                    @if (File::exists('products/'.$product->id.'/'.$product->imageName))
                        <div class="col-12 center">
                            <img class="imageProduct" src="/products/{{$product->id}}/{{$product->imageName}}" alt="{{$product->name}}">
                        </div>
                    @else
                        <div class="col-12 center">
                            <img class="imageProduct" src="/logo/notFound.png" alt="{{$product->name}}">
                        </div>
                    @endif
                    <div class="col-12" style="text-align: center">
                        <p>{{$product->name}}</p>
                        <p class="showPriceInBlock"> <b class="showPriceFont">{{number_format($product->price)}}</b> تومان</p>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12" style="display: flex;justify-content: center">
                <a style="padding-top: 150px;padding-bottom: 150px;direction: rtl;font-weight: bolder">محصولی وجود
                    ندارد.</a>
            </div>
        @endforelse
            <div class="col-12" style="display: flex;justify-content: center">
                <div class="col-9" style="text-align: center;padding: 20px;margin-bottom: 15px">
                    @for($index=$pages;$index>0;$index--)
                        @if($index==$currentPage)
                            <a href="/carTypeProducts/{{$carType_id}}/{{$category_id}}?page={{$index}}" style="border: 1px solid black;padding: 6px 12px;border-radius: 5px;background-color: #8f8f8f;color: black;text-decoration: none">{{$index}}</a>
                        @else
                            <a href="/carTypeProducts/{{$carType_id}}/{{$category_id}}?page={{$index}}" style="border: 1px solid black;padding: 6px 12px;border-radius: 5px;color: black;text-decoration: none">{{$index}}</a>
                        @endif
                    @endfor
                </div>
            </div>
    </div>
@endsection
