@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Add Match
    </div>

    <div class="card-body">
        <form action="{{ route("admin.match.store") }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group ">
                <label for="name">Team A Name</label>

                <select name="team_a_id" class="form-control" required>
                    <option value="">Select A Team</option>
                    @foreach(getTeam() as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
             
            </div>
            <div class="form-group ">
                <label for="name">Team B Name</label>

                <select name="team_b_id" class="form-control" required>
                    <option value="">Select B Team</option>
                    @foreach(getTeam() as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
             
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="title">Venue <span class="text-danger">(*)</span></label>
                <input type="text" id="venue" name="venue"  maxlength="250" class="form-control" required value="{{ old('venue', isset($match) ? $match->venue : '') }}">
          
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="title">Match Date <span class="text-danger">(*)</span></label>
                <input type="date" id="match_date" name="match_date"  maxlength="250" class="form-control" required value="{{ old('match_date', isset($match) ? $match->match_date : '') }}">
          
            </div>
           
            <div class="form-group {{ $errors->has('short_name') ? 'has-error' : '' }}">
                <label for="title">Match Status <span class="text-danger">(*)</span></label>
                <input type="text" id="match_status" name="match_status"  maxlength="250" class="form-control" required value="{{ old('match_status', isset($match) ? $match->match_status : '') }}">          
            </div>
            <div class="form-group ">
                <label for="name">Team Win Name</label>

                <select name="win_team_id" class="form-control" >
                    <option value="">Select Win Team</option>
                    @foreach(getTeam() as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
             
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