@extends('web.layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Match</h2>
        </div>

    </div>
    <div class="row">
        @foreach($match as $eachmatch)
        <div class="col-md-12 mb-4">
            <div class="card ">
                <div class="card-header">{{getTeamName($eachmatch->team_a_id)}} V {{getTeamName($eachmatch->team_b_id)}}
                    ODI {{date('Y')}}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{ url('public/images/teams/') }}/{{getTeamImage($eachmatch->team_a_id)}}"
                                                alt="post img"
                                                class="pull-left img-responsive thumb margin10 img-thumbnail"
                                                style="width: 100px;">
                                        </div>
                                        <div class="col-md-8">
                                            {{getTeamName($eachmatch->team_a_id)}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{ url('public/images/teams/') }}/{{getTeamImage($eachmatch->team_b_id)}}"
                                                alt="post img"
                                                class="pull-left img-responsive thumb margin10 img-thumbnail"
                                                style="width: 100px;">
                                        </div>
                                        <div class="col-md-8">
                                            {{getTeamName($eachmatch->team_b_id)}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <b>Date :</b>{{$eachmatch->match_date}} | <b>Venue : </b> {{$eachmatch->venue}}
                                </div>
                                <div class="col-md-6">
                                    <b>Match Status :</b> {{$eachmatch->match_status}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection