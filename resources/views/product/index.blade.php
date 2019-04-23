@php
    /** @var \App\Model\Product $product */
@endphp
@extends('base')

@section('content')

    <div class="row">
        <h1>All Products</h1>
    </div>
    <div class="row">
        <button class="button"><a href="{{ route('product.create') }}"><span class="fa fa-plus"></span></a></button>
    </div>

    <br/>
    <div>
        <div class="row">
            <div class="col-3"> Product name</div>
            <div class="col-1"> Status</div>
            <div class="col-1"> Quantity</div>
            <div class="col-1"> Price</div>
            <div class="col-2"> Manufacturer</div>
            <div class="col-2"> Category</div>
            <div class="col-2"> Action</div>
        </div>
        @foreach($products as $product)
            <div class="row">
                <div class="col-3">
                    <a href="/products/{{ $product->id }}">{{ $product->name }}</a>
                </div>
                <div class="col-1">
                    {{ $product->status }}
                </div>
                <div class="col-1 text-right">
                    {{ $product->quantity }}
                </div>
                <div class="col-1 text-right">
                    {{ $product->price }}
                </div>
                <div class="col-2">
                    {{ $product->manufacturer->name }}
                </div>
                <div class="col-2">
                    {{ $product->category->name }}
                </div>
                <div class="col-2">
                    <button class="button"><a href="{{ route('picture.add', ['product' => $product ]) }}">
                            <span class="fa fa-file-picture-o"></span></a></button>
                    <button class="button"><a href="{{ route('product.edit' , ['product' => $product]) }}">
                            <span class="fa fa-pencil"></span></a></button>
                    <form method="post" action="{{ route('product.destroy', ['product' => $product ]) }}"
                            class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button class="button"><span class="fa fa-trash"></span></button>
                    </form>
                </div>
            </div>
        @endforeach

    </div>
    <div class="row">
        {{ $products->onEachSide(0)->links() }}
    </div>

@endsection