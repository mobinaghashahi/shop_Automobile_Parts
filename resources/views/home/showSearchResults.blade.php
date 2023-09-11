@extends('layout.master')
@section('content')

    <div class="col-12 divAllProduct">
        @forelse($products as $product)
            <div class="col-3 products">
                <a href="/productDetails/{{$product->id}}" style="color: black">
                    @if (File::exists('products/'.$product->id.'/'.$product->imageName))
                        <div class="col-12 center">
                            <img class="imageProduct" src="products/{{$product->id}}/{{$product->imageName}}" alt="{{$product->name}}">
                        </div>
                    @else
                        <div class="col-12 center">
                            <img class="imageProduct" src="logo/notFound.png" alt="{{$product->name}}">
                        </div>
                    @endif
                    <div class="col-12" style="text-align: center">
                        <p>{{$product->name}}</p>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12" style="display: flex;justify-content: center">
                <a style="padding-top: 150px;padding-bottom: 150px;direction: rtl;font-weight: bolder">محصولی وجود
                    ندارد.</a>
            </div>
        @endforelse
    </div>
@endsection
