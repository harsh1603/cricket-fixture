@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Add Team
    </div>

    <div class="card-body">
        <form action="{{ route("admin.teams.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="title">Name <span class="text-danger">(*)</span></label>
                <input type="text" id="name" name="name"  maxlength="250" class="form-control" required value="{{ old('name', isset($teams) ? $teams->name : '') }}">
          
            </div>
            <div class="form-group {{ $errors->has('short_name') ? 'has-error' : '' }}">
                <label for="title">Sort Name <span class="text-danger">(*)</span></label>
                <input type="text" id="short_name" name="short_name"  maxlength="250" class="form-control" required value="{{ old('short_name', isset($teams) ? $teams->short_name : '') }}">
          
            </div>
     
      
            <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                <label for="price">Image</label>
                <input type="file" id="image" name="image" onchange="imagePreview(this)"  class="form-control" value="{{ old('image', isset($teams) ? $teams->image : '') }}" >
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



<script>
function imagePreview(input) {
      var ext = input.files[0]['name'].split(".");
    ext = ext[ext.length-1].toLowerCase();      
    var arrayExtensions = ["jpg","png"];

    if (arrayExtensions.lastIndexOf(ext) == -1) {
        alert("Wrong Image Format");
        $(input).val("");
        return false;
    }  
    if(input.files[0].size > 11000000) {
       alert("Please upload file less then 11MB. thenks!!");
       $(input).val("");
       return false;
     }
  
}
</script>

@endsection