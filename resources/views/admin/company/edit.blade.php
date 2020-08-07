@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Edit Company
    </div>

    <div class="card-body">
        <form action="{{ route('admin.company.update', [$company->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">Name <span class="text-danger">(*)</span></label>
                <input type="text" id="name" name="name"  maxlength="200" class="form-control" required value="{{ old('name', isset($company) ? $company->name : '') }}">
             
            </div>
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">Mobile No </label>
                <input type="number" id="mobile" name="mobile"   class="form-control"  value="{{ old('mobile', isset($company) ? $company->mobile : '') }}">
             
            </div>
           
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">Address </label>
                <input type="text" id="address" name="address"  class="form-control" required value="{{ old('address', isset($company) ? $company->address : '') }}">
             
            </div>
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">GST No. <span class="text-danger">(*)</span></label>
                <input type="text" id="gst_no" name="gst_no"  maxlength="200" class="form-control" required value="{{ old('gst_no', isset($company) ? $company->gst_no : '') }}">
             
            </div>
           
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection