@extends("layout.master")
<?php
use App\Models\Brand;
?>
@section('content')
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
                    <p style="text-align: right"><b>قیمت تکی:</b> {{number_format($product[0]->price)}} تومان</p>
                    <p style="text-align: right;direction: rtl">برای اطلاع از قیمت عمده این محصول تماس حاصل نمایید.</p>
                    <p style="text-align: right;direction: rtl;word-wrap: break-word">{{$product[0]->description}}</p>
                    <input type="text" name="id" value="{{$product[0]->id}}" hidden>
                </div>
                <div class="col-2" style="float: right; display: flex;justify-content: center">
                    <input type="number" value="1" min="1" max="{{stock($product[0]->id)}}" name="count" style="width: 35%;text-align: center">
                </div>
                <div class="col-9" style="float: right; display: flex;justify-content: center">
                    @if(stock($product[0]->id)>0&&$product[0]->availability=="instock")
                        <input class="inputSubmit" type="submit" value="خرید" style="width: 50%">
                    @else
                        <input disabled class="inputAlert" type="submit" value="ناموجود" style="width: 50%">
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
@endsection
