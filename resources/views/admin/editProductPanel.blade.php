@extends('admin.menu')
@section('content')
    <div class="main">
        <div class="col-12" style="text-align: center;padding-top: 15px;">
            <a style="background-color: #363636;padding: 10px;border-radius: 5px;color: white">ویرایش محصولات</a>
        </div>
        <div class="blockOfInputs">
            <div class="col-12" style="padding-top: 50px;display: flex;justify-content: center">
                <div class="col-11">
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
                    <table>
                        <tr>
                            <th class="editeTables"> ردیف</th>
                            <th class="editeTables">کد</th>
                            <th class="editeTables">نام محصول</th>
                            <th class="editeTables">قیمت (تومان)</th>
                            <th class="editeTables">تعداد</th>
                            <th class="editeTables">توضیحات</th>
                            <th class="editeTables">برند</th>
                            <th class="editeTables">نوع ماشین</th>
                            <th class="editeTables">تخفیف</th>
                            <th class="editeTables">دسته بندی</th>
                            <th class="editeTables">عملیات</th>
                        </tr>
                        @foreach ($products as $product)
                            <tr>
                                <td class="editeTables">{{$loop->index+1}}</td>
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{number_format($product->price)}}</td>
                                <td>{{$product->count}}</td>
                                <td>{{$product->description}}</td>
                                <td>{{$product->brandName}}</td>
                                <td>{{$product->carTypeName}}</td>
                                <td>{{$product->offName}}</td>
                                <td>{{$product->categoryName}}</td>
                                <td>

                                    <div class="col-6">
                                        <a href="/admin/deleteProduct/{{$product->id}}"> <img src="/logo/delete.png"
                                                                                              width="15"
                                                                                              height="15"></a>
                                    </div>
                                    <div class="col-6">
                                        <a href="/admin/editProduct/{{$product->id}}"> <img src="/logo/pen.png"
                                                                                            width="15" height="15"></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
