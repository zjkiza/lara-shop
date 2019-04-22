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
        <ul>
            <li>Name : {{ $product->name }}</li>
            <li>Price : {{ $product->description }}</li>
            <li>Price : {{ $product->price }}</li>
            <li>Quantity : {{ $product->quantity }}</li>
            <li>Manufacturer : {{ $product->manufacturer->name }}</li>
            <li>Category : {{ $product->category->name }}</li>
            <li>Details:
                <ul>
                    @foreach($product->details as $detail)

                        <li>{{ $detail->name }}</li>

                    @endforeach
                </ul>
            </li>
        </ul>


        @if($product->pictures->isNotEmpty())
             <div class="row">
                @foreach($product->pictures as $picture)
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset(sprintf('%s/%s', config('filesystems.disks.myDisks.storage'), $picture->name )) }}" >
                            <div class="card-body">
                                <form method="post" action="{{ route( 'picture.delete', [ 'picture' => $picture ] ) }}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    <a href="{{ asset(config('filesystems.disks.myDisks.storage').'/'.$picture->name) }}" class="btn btn-primary">Download</a>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        </div>
    </div>
@endsection