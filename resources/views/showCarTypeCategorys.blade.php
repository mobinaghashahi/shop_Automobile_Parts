@extends('layout.master')
@section('content')

    <div class="col-12" style="text-align: center;padding-top: 10px;font-weight: bolder">
        <h>
            محصولات {{$car[0]->name}}
        </h>
    </div>
    <div class="col-12 divAllProduct">
        @forelse($products as $product)
            <div class="col-2 products">
                <a href="/carTypeProducts/{{$product->carType_id}}/{{$product->category_id}}" style="color: black">
                    @if (File::exists('/category/'.$product->category_id.'/1.png'))
                        <div class="col-12 center">
                            <img class="imageProduct " src="/category/{{$product->category_id}}/1.png" alt="{{$product->name}}برند ">
                        </div>
                    @else
                        <div class="col-12 center">
                            <img class="imageProduct" src="/logo/notFound.png" alt="{{$product->name}}">
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
