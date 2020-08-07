@extends('web.layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Teams</h2>
        </div>

    </div>
    <div class="row">
        @foreach($teams as $team)
        <div class="col-md-12 mb-4">
            <div class="card ">
                <div class="card-header">{{$team->name}}</div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-8">

                        <img src="{{ url('public/images/teams/') }}/{{$team->image}}" alt="post img"
                            class="pull-left img-responsive thumb margin10 img-thumbnail" style="width: 100px;">
                        <p>{{$team->name}}</p>
                        <p><small>{{$team->short_name}}</small></p>
                    </div>
                    <div class="col-md-4">
                        <a class="btn btn-info"
                            href="{{route('player',[$team->id])}}" style="margin-bottom: 10px;">See All
                            Players</a>
                    </div>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection