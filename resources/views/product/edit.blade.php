@php
    /** @var \App\Model\Product $product */
    /** @var \App\Model\Manufacturer $manufacturer */
    /** @var \App\Model\Category $category */
    /** @var \App\Model\Detail $detail */
@endphp

@extends('base')

@section('content')

    <form action="{{ route('product.update', [ 'product' => $product->id ]) }}" method="post">

        @csrf
        @method('patch')

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control {{ $errors->has('name') ? 'alert-danger' : '' }}"
                       id="name" name="name" value="{{ $errors->has('name') ? old('name') : $product->name }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <textarea type="text" class="form-control {{ $errors->has('description') ? 'alert-danger' : '' }}"
                          id="description" name="description">{{ $errors->has('description') ?  old('description') : $product->description }}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="status" class="col-sm-2 col-form-label">Status</label>

            @php $status_value = old('status') ?? $product->status @endphp

            @foreach($statuses as $status)
                <div class="form-check {{ $errors->has('status') ? 'alert-danger' : '' }}">
                    <label for="status" class="col-sm-2 col-form-label">{{ $status }}</label>
                    <input type="radio" class="form-control" id="status" name="status" value="{{ $status }}" {{ $status_value===$status ? 'checked' : '' }}>
                </div>
            @endforeach
        </div>
        <div class="form-group row">
            <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
            <div class="col-sm-10">
                <input type="text" class="form-control {{ $errors->has('quantity') ? 'alert-danger' : '' }}"
                       id="quantity" name="quantity" value="{{ $errors->has('quantity') ? old('quantity') : $product->quantity }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="price" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-10">
                <input type="text" class="form-control {{ $errors->has('price') ? 'alert-danger' : '' }}"
                       id="price" name="price" value="{{ $errors->has('price') ? old('price') : $product->price }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="manufacturer" class="col-sm-2 col-form-label">Manufacturer</label>
            <div class="col-sm-10">
                <select id="manufacturer" name="manufacturer_id" class="form-control">

                    @php $manufacturer_id = old('manufacturer_id') ?? $product->manufacturer->id @endphp

                    @foreach($manufacturers as $manufacturer)
                        <option value="{{ $manufacturer->id }}" {{ (int)$manufacturer_id===$manufacturer->id ? 'selected' : ''  }}>
                            {{ $manufacturer->manufacturer_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="category" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-10">
                <select id="category" name="category_id" class="form-control">

                    @php $category_id = old('category_id') ?? $product->category->id @endphp

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (int)$category_id===$category->id ? 'selected' : ''  }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="detail" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-10">

                @php $checked_id = old('category') ?? $checkedIds @endphp

                @foreach($details as $detail)
                    <input id="details" name="details[]" type="checkbox" value="{{ $detail->id }}"
                            {{ null !== $checked_id ? ( in_array($detail->id, $checked_id) ? 'checked' : '' )  : ''}}
                    >
                    <label for="details" class="control-label">{{ $detail->name }}</label>
                @endforeach
            </div>
        </div>

        <div class="form-group row">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

        @include('layer.error')

    </form>
@endsection
