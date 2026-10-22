@extends("layout.master")
@section('content')
    <link rel="stylesheet" href="{{ asset('css/cart-quantity.css') }}?v=1">
    <div class="col-12 blockCart" data-cart data-csrf-token="{{ csrf_token() }}">
        @if (\Session::has('error'))
            <div class="notification notificationError">
                <p>{!! \Session::get('error') !!}</p>
                <span class="notification_progress"></span>
            </div>
        @endif
        <div class="col-6 blockCartRight">
            @foreach($products as  $value)
                @php
                    $quantity = (int) session('products.'.$value[0]['id']);
                    $availableStock = $value[0]['availability'] === 'instock' ? max(0, stock($value[0]['id'])) : 0;
                @endphp
                <div class="col-12 blockProductsCart" data-cart-row data-product-id="{{ $value[0]['id'] }}"
                     data-quantity="{{ $quantity }}" data-max-quantity="{{ $availableStock }}">
                    <div class="col-3">
                        <a href="/productDetails/{{$value[0]['id']}}">
                            @if (File::exists('products/'.$value[0]['id'].'/'.$value[0]['imageName']))
                                    <img alt="{{$value[0]['name']}}" title="{{$value[0]['name']}}" style="padding: 5px"
                                         src="/products/{{$value[0]['id']}}/{{$value[0]['imageName']}}" width="150" height="150">
                            @else
                                    <img width="150" height="150" style="padding: 5px" src="/logo/notFound.png" alt="{{$value[0]['name']}}">
                            @endif
                        </a>
                    </div>
                    <div class="col-9" style="margin-top:15px">
                        <div class="col-12">
                            <a>{{$value[0]['name']}}</a>
                        </div>
                        <div class="col-12" style="margin-top: 10px">
                            <div class="cart-quantity" role="group" aria-label="تعداد محصول">
                                <button type="button" class="cart-quantity__button" data-cart-step="-1"
                                        data-url="/cart/decreaseCount" aria-label="کاهش تعداد {{ $value[0]['name'] }}"
                                        @disabled($quantity <= 1)>
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                                        <path d="M5 12h14"/>
                                    </svg>
                                </button>
                                <output class="cart-quantity__value" data-cart-quantity aria-label="تعداد">{{ $quantity }}</output>
                                <button type="button" class="cart-quantity__button cart-quantity__button--increase" data-cart-step="1"
                                        data-url="/cart/increaseCount" aria-label="افزایش تعداد {{ $value[0]['name'] }}"
                                        @disabled($quantity >= $availableStock)>
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                                        <path d="M5 12h14M12 5v14"/>
                                    </svg>
                                </button>
                            </div>
                            <p class="cart-quantity-feedback" data-cart-feedback role="status" aria-live="polite"></p>
                        </div>
                        <div class="col-12">
                            <div class="col-2 recyclebin">
                                <a data-cart-remove href="/cart/deleteOfCart/{{$value[0]['id']}}">
                                    <img alt="حذف" title="حذف" class="imageBring" src="/logo/recyclebin.png" width="30"
                                         height="30">
                                    <img alt="حذف" title="حذف" class="imageTop" src="/logo/recyclebinopen.png"
                                         width="30" height="30">
                                </a>
                            </div>
                        </div>
                        <div class="col-12">
                            <p class="textPriceDetailsCart">
                                <b>قیمت:</b> <span data-cart-line-total>{{number_format($value[0]['price']*session('products.'.$value[0]['id']))}}</span>
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
                <p style="padding-right: 20px; direction: rtl"><b><span data-cart-total>{{number_format($totalPrice)}}</span> تومان</b></p>
            </div>
            <div class="col-12" style="padding: 20px 0px 30px 0px">
                <hr style="width: 80%;color: rgba(0,0,0,0.8);">
            </div>
            <form action="/cart/addUserInformation" method="get">
                <div class="col-12" style="display: flex;justify-content: center">
                    <input style="color:#000000;width: 90%;" name="enter" data-cart-checkout class="inputSubmit" type="submit" value="ادامه جهت تسویه حساب">
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/cart-quantity.js') }}?v=1" defer></script>
@endsection
