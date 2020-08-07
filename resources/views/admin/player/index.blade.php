@extends('layouts.admin')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success"  href="{{ route("admin.player.add") }}">
                Add New
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
      Player List
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">
                            S.No
                        </th>
                        <th>
                           Name
                        </th>
                        <th>
                        Specialist
                        </th>
                        <th>Team Name</th>
                       <th>Logo</th>
                        <th>
                        Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($player as $key => $eachplayer)
                        <tr data-entry-id="{{ $eachplayer->id }}">
                            <td>
                                {{$key+1}}
                            </td>
                            <td>
                                {{ $eachplayer->name ?? '' }}
                            </td>
                            <td>
                                {{ $eachplayer->specialist ?? '' }}
                            </td>
                            <td>
                                {{ getTeamName($eachplayer->team_id) ?? '' }}
                            </td>
                            <td><img src="{{ url('public/images/player/') }}/<?php echo $eachplayer->image; ?>" alt="post img" class="" style="width: 100px;"></td>
                            <td>

                     
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.player.edit', $eachplayer->id) }}">
                                       Edit
                                    </a>
                
                                    <form action="{{ route('admin.player.deletes') }}" method="get" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="get">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{ $eachplayer->id }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                           
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination pull-right">
    {{ $player->render() }} 
</div>
    </div>
</div>

@endsection