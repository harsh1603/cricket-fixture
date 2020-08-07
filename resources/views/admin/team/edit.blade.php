@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Edit Team
    </div>

    <div class="card-body">
        <form action="{{ route('admin.teams.update', [$teams->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="title">Name <span class="text-danger">(*)</span></label>
                <input type="text" id="name" name="name"  maxlength="220" required class="form-control"
                    value="{{ old('name', isset($teams) ? $teams->name : '') }}">
                @if($errors->has('title'))
                <em class="invalid-feedback">
                    {{ $errors->first('title') }}
                </em>
                @endif
                <p class="helper-block">

                </p>
            </div>
            <div class="form-group {{ $errors->has('short_name') ? 'has-error' : '' }}">
                <label for="title">Sort Name <span class="text-danger">(*)</span></label>
                <input type="text" id="short_name" name="short_name"  maxlength="250" class="form-control" required value="{{ old('short_name', isset($teams) ? $teams->short_name : '') }}">
          
            </div>
      
            <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                <label for="price">Image
                @if(@$teams->image !='')  
                            <a href="{{asset('public/images/teams/').'/'.$teams->image}}"  target="blank">View</a>
                            
                            @endif
                </label>
                <input type="file" id="image" name="image"  class="form-control" value="{{ old('image', isset($teams) ? $teams->image : '') }}" >
                @if($errors->has('image'))
                    <em class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </em>
                @endif
                <p class="helper-block">
                   
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection