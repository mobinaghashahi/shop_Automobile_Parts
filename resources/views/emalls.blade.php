<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>
        لیست محصولات موجود و فعال فروشگاه پارس می
    </title>
    <meta name="description"
          content="لیست محصولات موجود و فعال و فروشگاه اینترنتی پارس می،لپ تاپ،موبایل،مانیتور،کامپیوترهای رومیزی،تبلت،ماوس،کیبورد،کیف های ضد آب لپ تاپ"/>
    <link href="/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/Plugin/bootstrap-3.3.7-dist/css/bootstrap-theme.css" rel="stylesheet"/>
    <link href="/Content/CSS/update/site.min.css" rel="stylesheet"/>
    <style type="text/css">
        body {
            direction: rtl;
        }

        .container {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        table th {
            text-align: right;
        }

        table tr td.price {
            font-size: 18px;
        }

        table th {
            font-size: 22px;
        }

        table th.img {
            width: 300px;
        }

        table th.price {
            width: 250px;
        }

        td {
            vertical-align: middle !important;
        }

        h1 {
            padding-bottom: 20px;
            padding-right: 20px;
        }

    </style>
</head>
<body>
<form method="post" action="./Product" id="form1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1>لیست محصولات موجود و فعال فروشگاه یدک اصلی</h1>

                        <table class="table table-bordered">
                            <thead>
                            <th class="title">عنوان</th>
                            <th class="img">تصویر</th>
                            <th class="price">قیمت (تومان)</th>
                            <th class="price">قیمت با تخفیف (تومان)</th>
                            </thead>
                            <tbody>

                            @foreach($products as $product)

                                <tr>
                                    <td>
                                        <a href='/productDetails/{{$product->id}}'>{{$product->name}}</a>
                                    </td>
                                    <td style="text-align : center">
                                        @if (File::exists('products/'.$product->id.'/'.$product->imageName))
                                            <img style="max-width: 64px; max-height: 48px;"
                                                 src="/products/{{$product->id}}/{{$product->imageName}}"
                                                 alt='{{$product->name}}'
                                                 title='{{$product->name}}'/>
                                        @else
                                            <div class="col-12 center">
                                                <img style="max-width: 64px; max-height: 48px;" src="/logo/notFound.png" alt="{{$product->name}}">
                                            </div>
                                        @endif
                                    </td>
                                    <td class="price">
                                        {{$product->price}}
                                    </td>
                                    <td class="price">
                                        {{$product->price}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
</body>
</html>
