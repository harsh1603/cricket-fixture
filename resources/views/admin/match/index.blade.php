@extends('layouts.admin')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success"  href="{{ route("admin.match.add") }}">
                Add New
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
      Temas List
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
                           Team A Name
                        </th>
                        <th>
                       Team B Name
                        </th>
                        <th>Venue</th>
                       <th>Match Date</th>
                       <th>Match Status</th>
                        <th>
                        Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($match as $key => $eachmatch)
                        <tr data-entry-id="{{ $eachmatch->id }}">
                            <td>
                                {{$key+1}}
                            </td>
                            <td>
                                {{ getTeamName($eachmatch->team_a_id) ?? '' }}
                            </td>
                            <td>
                                {{ getTeamName($eachmatch->team_b_id) ?? '' }}
                            </td>
                            <td>
                                {{ $eachmatch->venue ?? '' }}
                            </td>
                            <td>
                                {{ $eachmatch->match_date ?? '' }}
                            </td>
                            <td>
                                {{ $eachmatch->match_status ?? '' }}
                            </td>
                            <td>

                     
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.match.edit', $eachmatch->id) }}">
                                       Edit
                                    </a>
                
                                    <form action="{{ route('admin.match.deletes') }}" method="get" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="get">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{ $eachmatch->id }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                           
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination pull-right">
    {{ $match->render() }} 
</div>
    </div>
</div>

@endsection