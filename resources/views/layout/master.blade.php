<?php
use App\Models\Brand;
use App\Models\CarType;
?>

@include('layout.header',['brands'=>Brand::where('id','>',1)->get(),
'carsSaypa'=>CarType::where('companyName','=','سایپا')->get(),
'carsIranKhodro'=>CarType::where('companyName','=','ایران خودرو')->get()
])
@yield('content')
@include('layout.footer')
