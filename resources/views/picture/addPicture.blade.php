@extends('base')

@section('content')

    <div class="card">
        <div class="card-header" >Add Picture For Product</div>

        <div class="card-body">
            @include('product.product')
            @include('picture.showForProduct')
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form action="{{ route('picture.save', [ 'product' => $product ]) }}" method="post" class="dropzone" enctype="multipart/form-data">
                @csrf

            </form>
        </div>
    </div>

@endsection