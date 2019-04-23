@php
    /** @var \App\Model\Product $product */
    /** @var \App\Model\Detail $detail */
    /** @var \App\Model\Picture $picture */
@endphp

@extends('base')

@section('content')

    <div class="card">
    <div class="card-header" >Product</div>
        <div class="card-body">
            @include('product.product')
            @include('picture.showForProduct')
        </div>
    </div>

@endsection