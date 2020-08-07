@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.product.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.products.pricestore",[$product_id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
           
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