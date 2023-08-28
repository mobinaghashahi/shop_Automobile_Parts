@extends("layout.master")
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
                <div class="col-12" style="display: flex;justify-content: center">
                    <img src="/products/{{$product[0]->id}}/{{$product[0]->imageName}}" width="60%" height="60%" title="{{$product[0]->name}}" alt="{{$product[0]->name}}">
                </div>
            </div>
            <div class="col-5">
                <div class="col-12" style="margin-right: 40px;font-size: 30px">
                    <p style="text-align: right;font-weight: bolder">{{$product[0]->name}}</p>
                </div>
                <div class="col-12 productsDetailsText">
                    <p style="text-align: right"><b>برند:</b> {{$product[0]->brandName}}</p>
                    <p style="text-align: right"><b>موجودی:</b> {{stock($product[0]->id)}} عدد</p>
                    <p style="text-align: right"><b>قیمت تکی:</b> {{number_format($product[0]->price)}} تومان</p>
                    <p style="text-align: right;direction: rtl">برای اطلاع از قیمت عمده این محصول تماس حاصل نمایید.</p>
                    <p style="text-align: right;direction: rtl;word-wrap: break-word">{{$product[0]->description}}</p>
                    <input type="text" name="id" value="{{$product[0]->id}}" hidden>
                </div>
                <div class="col-3" style="float: right; display: flex;justify-content: center">
                    <input type="number" value="1" min="1" max="{{stock($product[0]->id)}}" name="count" style="width: 35%;text-align: center">
                </div>
                <div class="col-9" style="float: right; display: flex;justify-content: center">
                    @if(stock($product[0]->id)>0&&$product[0]->availability=="instock")
                        <input class="inputSubmit" type="submit" value="خرید" style="width: 50%">
                    @else
                        <input disabled class="inputAlert" type="submit" value="ناموجود" style="width: 50%">
                    @endif
                </div>
            </div>
        </div>
    </form>
@endsection
