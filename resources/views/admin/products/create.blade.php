@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.product.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.products.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <div class="form-group {{ $errors->has('company_id') ? 'has-error' : '' }} col-md-4">
                <label for="name">Company*</label>
                <select name="company_id" id="company_id" class="form-control" required>

                <option value="">Select Company</option>
                    @foreach(getCompany() as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                    </select>
            </div>
            <div class="form-group {{ $errors->has('brand_name') ? 'has-error' : '' }} col-md-4">
                <label for="name">Brand Name*</label>
                <input type="text" id="brand_name" name="brand_name" class="form-control" required value="{{ old('brand_name', isset($product) ? $product->brand_name : '') }}">
                @if($errors->has('brand_name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('brand_name') }}
                    </em>
                @endif
               
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} col-md-4">
                <label for="name">Date*</label>
                <input type="date" id="created_date" name="created_date" class="form-control" required >
               
               
            </div>
            </div>
            <div class="row">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} col-md-6">
                <label for="name">{{ trans('global.product.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" required value="{{ old('name', isset($product) ? $product->name : '') }}">
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.product.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} col-md-6">
                <label for="name">Product Code*</label>
                <input type="text" id="product_code" name="product_code" class="form-control" required value="{{ old('product_code', isset($product) ? $product->product_code : '') }}">
                @if($errors->has('product_code'))
                    <em class="invalid-feedback">
                        {{ $errors->first('product_code') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.product.fields.name_helper') }}
                </p>
            </div>
            </div>
            <div class="row">
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }} col-md-12">
                <label for="description">{{ trans('global.product.fields.description') }}</label>
                <textarea id="description" name="description" class="form-control ">{{ old('description', isset($product) ? $product->description : '') }}</textarea>
                @if($errors->has('description'))
                    <em class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.product.fields.description_helper') }}
                </p>
            </div>
            </div>
            <div class="row">
            <div class="form-group {{ $errors->has('dp') ? 'has-error' : '' }} col-md-6">
                <label for="dp">DP*</label>
                <input type="number" id="dp" name="dp" class="form-control" required value="" step="0.01">
                @if($errors->has('price'))
                    <em class="invalid-feedback">
                        {{ $errors->first('dp') }}
                    </em>
                @endif
                <p class="helper-block">
                  
                </p>
            </div>
           
            <div class="form-group {{ $errors->has('qty') ? 'has-error' : '' }} col-md-6">
                <label for="price">Quantity*</label>
                <input type="number" id="qty" name="qty" class="form-control" required value="" step="0.01">
                @if($errors->has('qty'))
                    <em class="invalid-feedback">
                        {{ $errors->first('qty') }}
                    </em>
                @endif
                <p class="helper-block">
                  
                </p>
            </div>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection