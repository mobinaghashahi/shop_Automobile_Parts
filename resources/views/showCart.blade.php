@extends("layout.master")
@section('content')
    <div class="col-12 blockCart">
        <div class="col-6 blockCartRight">
            @foreach($products as  $value)
                <div class="col-12 blockProductsCart">
                    <div class="col-3">
                        <a href="/productDetails/{{$value[0]['id']}}">
                            <img alt="{{$value[0]['name']}}" title="{{$value[0]['name']}}" style="padding: 5px"
                                 src="/products/{{$value[0]['id']}}/1.png" width="150" height="150">
                        </a>
                    </div>
                    <div class="col-9" style="margin-top:15px">
                        <div class="col-12">
                            <a>{{$value[0]['name']}}</a>
                        </div>
                        <div class="col-12" style="margin-top: 10px">
                            <div class="increaseCountDiv">
                                <form style="width: 100%;height: 100%" action="/cart/increaseCount" method="post">
                                    @csrf
                                    <input type="text" hidden name="id" value="{{$value[0]['id']}}">
                                    <input type="text" hidden name="count"
                                           value="{{session('products.'.$value[0]['id'])+1}}">
                                    <input name="operation" type="submit" value="+"
                                           style="margin: 0px;padding: 0px;height: 5%;width: 25px">
                                </form>
                            </div>
                            <div class="countDiv">
                                <input name="count" type="text" value="{{session('products.'.$value[0]['id'])}}"
                                       style="text-align: center;width: 20%;margin: 0px;padding: 0px;height: 5%;width: 20px;"
                                       readonly>
                            </div>
                            <div class="decreaseCount">
                                <form style="width: 100%;height: 100%" action="/cart/decreaseCount" method="post">
                                    @csrf
                                    <input type="text" hidden name="id" value="{{$value[0]['id']}}">
                                    <input type="text" hidden name="count"
                                           value="{{session('products.'.$value[0]['id'])-1}}">
                                    <input name="operation" type="submit" value="-"
                                           style="margin: 0px;padding: 0px;height: 5%;width: 25px">
                                </form>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="col-2 recyclebin">
                                <a href="/cart/deleteOfCart/{{$value[0]['id']}}">
                                    <img alt="حذف" title="حذف" class="imageBring" src="/logo/recyclebin.png" width="30"
                                         height="30">
                                    <img alt="حذف" title="حذف" class="imageTop" src="/logo/recyclebinopen.png"
                                         width="30" height="30">
                                </a>
                            </div>
                        </div>
                        <div class="col-12">
                            <p class="textPriceDetailsCart">
                                <b>قیمت:</b> {{number_format($value[0]['price']*session('products.'.$value[0]['id']))}}
                            </p>
                        </div>
                    </div>

                </div>
                <hr style="width: 80%;color: rgba(0,0,0,0.8)">
            @endforeach
        </div>
        <div class="col-3 blockCartLeft">
            <div class="col-6">
                <p style="padding-right: 20px">مبلغ کل:</p>
            </div>
            <div class="col-6">
                <p style="padding-right: 20px; direction: rtl"><b>{{number_format($totalPrice)}} تومان</b></p>
            </div>
            <div class="col-6">
                <p style="padding-right: 20px">هزینه ارسال:</p>
            </div>
            <div class="col-6">
                <p style="padding-right: 20px"><b>{{number_format($sendPrice)}} تومان</b></p>
            </div>
            <hr style="width: 80%;color: rgba(0,0,0,0.8)">
            <div class="col-6">
                <p style="padding-right: 20px">مبلغ قابل پرداخت</p>
            </div>
            <div class="col-6">
                <p style="padding-right: 20px"><b>{{number_format($sendPrice+$totalPrice)}} تومان</b></p>
            </div>
            <div class="col-12" style="display: flex;justify-content: center">
                <input style="color:black;width: 90%;" name="enter" class="inputSubmit" type="submit" value="پرداخت">
            </div>
        </div>
    </div>
@endsection
