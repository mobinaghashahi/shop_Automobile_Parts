@extends('layout.master')

@section('content')
    @include('layout.slideShow')
    @include('home.bestSelling')
    
    <hr style="border-top: 2px solid #FB8500; width: 80%;">

    @include('home.latestProducts')
@endsection
