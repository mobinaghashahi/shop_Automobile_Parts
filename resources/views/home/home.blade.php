@extends('layout.master')

@section('content')
    @include('layout.slideShow')
    @include('home.latestProducts')

    <hr style="border-top: 2px solid #FB8500; width: 80%;">

    @include('home.categorys')
@endsection
