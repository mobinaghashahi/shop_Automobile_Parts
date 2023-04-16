@extends("layout.master")
@section('content')
    <form method="post" name="enter" action="/cart/addToCart">
        @csrf
        <div class="col-12" style="padding: 10px 0px 10px 0px">
            <div style="text-align: right;direction: rtl">
                @if (\Session::has('msg'))
                    <div class="col-12" style="justify-content: center;display: flex">
                        <div class="col-3">
                            <div class="successMessage" style="margin-top: 25px">
                                {!! \Session::get('msg') !!}
                            </div>
                        </div>
                    </div>
                @endif
                @if ($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="col-12" style="justify-content: center;display: flex">
                            <div class="col-3">
                                <p style="color: #ffffff;text-align: center;background-color: #ff2e2e;direction:rtl;line-height: 15px;padding: 10px;border-radius: 10px">{{$error}}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="col-7">
                <div class="col-12" style="display: flex;justify-content: center">
                    <img src="/products/{{$product[0]->id}}/1.png" width="60%" height="60%" title="{{$product[0]->name}}" alt="{{$product[0]->name}}">
                </div>
            </div>
            <div class="col-5">
                <div class="col-12" style="margin-right: 40px;font-size: 30px">
                    <p style="text-align: right;font-weight: bolder">{{$product[0]->name}}</p>
                </div>
                <div class="col-12" style="margin: 0px 40px 0px 20px">
                    <p style="text-align: right">برند: {{$product[0]->brandName}}</p>
                    <p style="text-align: right">موجودی: {{stock($product[0]->id)}} عدد</p>
                    <p style="text-align: right">قیمت تکی: {{number_format($product[0]->price)}} تومان</p>
                    <p style="text-align: right">قیمت عمده: 1000 تومان</p>
                    <p style="text-align: right;direction: rtl">{{$product[0]->description}}</p>
                    <input type="text" name="id" value="{{$product[0]->id}}" hidden>
                </div>
                <div class="col-3" style="float: right; display: flex;justify-content: center">
                    <input type="number" value="1" min="1" name="count" style="width: 35%;text-align: center">
                </div>
                <div class="col-9" style="float: right; display: flex;justify-content: center">
                    @if(stock($product[0]->id)>0)
                        <input class="inputSubmit" type="submit" value="خرید" style="width: 50%">
                    @else
                        <input disabled class="inputAlert" type="submit" value="ناموجود" style="width: 50%">
                    @endif
                </div>
            </div>
        </div>
    </form>
@endsection
