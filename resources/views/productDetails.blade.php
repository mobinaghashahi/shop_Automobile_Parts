@extends("layout.master")
@section('content')
    <div class="col-12" style="padding: 10px 0px 10px 0px">
        <div class="col-7">
            <div class="col-12" style="display: flex;justify-content: center">
                <img src="/products/{{$product[0]->id}}/1.png" width="60%" height="60%">
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
            </div>
            <div class="col-10" style="margin-right: 40px">
                @if(stock($product[0]->id)>0)
                    <input class="inputSubmit" type="submit" value="خرید">
                @else
                    <input disabled class="inputAlert" type="submit" value="ناموجود">
                @endif
            </div>
        </div>
    </div>
@endsection
