@extends('web.layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Points</h2>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card ">
                <div class="card-header">ODI Points</div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Logo</th>
                                    <th>Team</th>
                                    <th>Match</th>
                                    <th>Won</th>
                                    <th>Lose</th>
                                    <th>Tied</th>
                                    <th>Points</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($points as $point)

                                <tr>
                                    <td>
                                        <img src="{{ url('public/images/teams/') }}/{{getTeamImage($point->team_id)}}"
                                            alt="post img" class="pull-left img-responsive thumb margin10 img-thumbnail"
                                            style="width: 100px;">
                                    </td>
                                    <td>{{getTeamName($point->team_id)}}</td>
                                    <td>{{$point->played}}</td>
                                    <td>{{$point->match_won}}</td>
                                    <td>{{$point->match_lose}}</td>
                                    <td>{{$point->match_tied}}</td>
                                    <td>{{$point->points}}</td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endsection