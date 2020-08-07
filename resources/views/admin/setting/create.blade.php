@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Setting
    </div>

    <div class="card-body">
        <form action="{{ route("admin.setting.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
      
            <div class="form-group {{ $errors->has('company_id') ? 'has-error' : '' }} ">
                <label for="name">Company Name*</label>
                <input type="text" id="company_name" name="company_name" class="form-control" value="{{ old('company_name', isset($setting) ? $setting->company_name : '') }}" required >
            </div>
     
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} ">
                <label for="name">Mobile No*</label>
                <input type="text" id="mobile" name="mobile" class="form-control" required value="{{ old('mobile', isset($setting) ? $setting->mobile : '') }}">
             
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Address*</label>
                <input type="text" id="address" name="address" class="form-control" required value="{{ old('address', isset($setting) ? $setting->address : '') }}">
             
            </div>
           
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">GST No*</label>
                <input type="text" id="gst" name="gst" class="form-control" required value="{{ old('gst', isset($setting) ? $setting->gst : '') }}">
             
            </div>
            
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection