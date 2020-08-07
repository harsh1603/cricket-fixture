@extends('web.layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Players</h2>
        </div>

    </div>
    <div class="row">
        @foreach($player as $key => $teamplayer)
        <div class="col-md-4 mb-4">
            <div class="card" style="width:20rem;margin:20px 0 24px 0">
                <img class="card-img-top" src="{{ url('public/images/player/') }}/{{$teamplayer->image}}" alt="image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">{{$teamplayer->name}}</h4>
                    <p class="card-text">{{$teamplayer->specialist}}</p>
                    <p class="card-text">{{$teamplayer->jersey_no}}</p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$key}}">See Profile</button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal{{$key}}">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">{{$teamplayer->name}} History</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         <b>No of Run</b>: {{$teamplayer->no_of_match}}<br>
         <b>No of Match</b>: {{$teamplayer->no_of_run}}<br>
         <b>Highest Score</b>: {{$teamplayer->highest_score}}<br>
         <b>No of Wicket</b>: {{$teamplayer->no_of_wicket}}<br>
         <b>No of Catch</b>: {{$teamplayer->no_of_catch}}<br>
         <b>No of Six</b>: {{$teamplayer->no_of_six}}<br>
         <b>No of Four</b>: {{$teamplayer->no_of_four}}<br>
        </div>
  
        
      </div>
    </div>
  </div>
        @endforeach
    </div>
</div>
@endsection