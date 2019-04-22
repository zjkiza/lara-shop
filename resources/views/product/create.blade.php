@php
/** @var \App\Model\Manufacturer $manufacturer */
/** @var \App\Model\Category $category */
/** @var \App\Model\Detail $detail */
@endphp

@extends('base')

@section('content')

    <form action="{{ route('product.store') }}" method="post">

        @csrf

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control {{ $errors->has('name') ? 'alert-danger' : '' }}"
                    id="name" name="name" value="{{ old('name') }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <textarea type="text" class="form-control {{ $errors->has('description') ? 'alert-danger' : '' }}"
                    id="description" name="description">{{ old('description') }}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="status" class="col-sm-2 col-form-label">Status</label>

                @foreach($statuses as $status)
                    <div class="form-check {{ $errors->has('status') ? 'alert-danger' : '' }}">
                            <label for="status" class="col-sm-2 col-form-label">{{ $status }}</label>
                            <input type="radio" class="form-control" id="status" name="status" value="{{ $status }}" {{ old('status')===$status ? 'checked' : '' }}>
                     </div>
                @endforeach
        </div>
        <div class="form-group row">
            <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
            <div class="col-sm-10">
                <input type="text" class="form-control {{ $errors->has('quantity') ? 'alert-danger' : '' }}"
                    id="quantity" name="quantity" value="{{ old('quantity') }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="price" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-10">
                <input type="text" class="form-control {{ $errors->has('price') ? 'alert-danger' : '' }}"
                    id="price" name="price" value="{{ old('price') }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="manufacturer" class="col-sm-2 col-form-label">Manufacturer</label>
            <div class="col-sm-10">
                <select id="manufacturer" name="manufacturer_id" class="form-control">
                    @foreach($manufacturers as $manufacturer)
                        <option value="{{ $manufacturer->id }}" {{ (int)old('manufacturer_id')===$manufacturer->id ? 'selected' : ''  }}>
                            {{ $manufacturer->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="category" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-10">
                <select id="category" name="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (int)old('category_id')===$category->id ? 'selected' : ''  }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="detail" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-10">
                    @foreach($details as $detail)
                        <input id="details" name="details[]" type="checkbox" value="{{ $detail->id }}"
                                {{ null !== old('details') ? ( in_array($detail->id, old('details')) ? 'checked' : '' )  : ''}}>
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
