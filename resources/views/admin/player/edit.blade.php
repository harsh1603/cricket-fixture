@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Edit Player
    </div>

    <div class="card-body">
        <form action="{{ route('admin.player.update', [$player->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

           
            <div class="form-group ">
                <label for="name">Team Name</label>

                <select name="team" class="form-control" >
                    <option value="">Select Team</option>
                    @foreach(getTeam() as $value)
                    <option value="{{$value->id}}" {{$value->id==$player->team_id?'selected':''}}>{{$value->name}}</option>
                    @endforeach
                </select>
             
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="title">First Name <span class="text-danger">(*)</span></label>
                <input type="text" id="first_name" name="first_name"  maxlength="250" class="form-control" required value="{{ old('first_name', isset($player) ? $player->first_name : '') }}">
          
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="title">Last Name <span class="text-danger">(*)</span></label>
                <input type="text" id="last_name" name="last_name"  maxlength="250" class="form-control" required value="{{ old('last_name', isset($player) ? $player->last_name : '') }}">
          
            </div>
           
            <div class="form-group {{ $errors->has('short_name') ? 'has-error' : '' }}">
                <label for="title">Specialist <span class="text-danger">(*)</span></label>
                <input type="text" id="specialist" name="specialist"  maxlength="250" class="form-control" required value="{{ old('specialist', isset($player) ? $player->specialist : '') }}">
          
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="title">Jersey No. <span class="text-danger">(*)</span></label>
                <input type="number" id="jersey_no" name="jersey_no"  min="0" class="form-control" required value="{{ old('jersey_no', isset($player) ? $player->jersey_no : '') }}">
          
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="title">No. Of Matach Played. <span class="text-danger">(*)</span></label>
                <input type="number" id="no_of_match" name="no_of_match"  min="0" class="form-control" required value="{{ old('no_of_match', isset($player) ? $player->no_of_match : '') }}">
          
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="title">Total Run. <span class="text-danger">(*)</span></label>
                <input type="number" id="no_of_run" name="no_of_run"  min="0" class="form-control" required value="{{ old('no_of_run', isset($player) ? $player->no_of_run : '') }}">
          
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="title">Highest Run. <span class="text-danger">(*)</span></label>
                <input type="number" id="highest_score" name="highest_score"  min="0" class="form-control" required value="{{ old('highest_score', isset($player) ? $player->highest_score : '') }}">
          
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="title">No. Of Six <span class="text-danger">(*)</span></label>
                <input type="number" id="no_of_six" name="no_of_six"  min="0" class="form-control" required value="{{ old('no_of_six', isset($player) ? $player->no_of_six : '') }}">
          
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="title">No. Of Four <span class="text-danger">(*)</span></label>
                <input type="number" id="no_of_four" name="no_of_four"  min="0" class="form-control" required value="{{ old('no_of_four', isset($player) ? $player->no_of_four : '') }}">
          
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="title">No. Of Catch Taken <span class="text-danger">(*)</span></label>
                <input type="number" id="no_of_catch" name="no_of_catch"  min="0" class="form-control" required value="{{ old('no_of_catch', isset($player) ? $player->no_of_catch : '') }}">
          
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="title">No. Of Wicket Taken <span class="text-danger">(*)</span></label>
                <input type="number" id="no_of_wicket" name="no_of_wicket"  min="0" class="form-control" required value="{{ old('no_of_wicket', isset($player) ? $player->no_of_wicket : '') }}">
          
            </div>
            <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                <label for="price">Image
                @if(@$player->image !='')  
                            <a href="{{asset('public/images/player/').'/'.$player->image}}"  target="blank">View</a>
                            
                            @endif
                </label>
                <input type="file" id="image" name="image"  class="form-control" value="{{ old('image', isset($player) ? $player->image : '') }}" >
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