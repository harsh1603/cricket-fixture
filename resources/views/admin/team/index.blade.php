@extends('layouts.admin')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success"  href="{{ route("admin.teams.add") }}">
                Add New
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
      Teams List
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
                      Short Name
                        </th>
                       <th>Logo</th>
                        <th>
                        Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teams as $key => $eachTemas)
                        <tr data-entry-id="{{ $eachTemas->id }}">
                            <td>
                                {{$key+1}}
                            </td>
                            <td>
                                {{ $eachTemas->name ?? '' }}
                            </td>
                            <td>
                                {{ $eachTemas->short_name ?? '' }}
                            </td>
                            <td><img src="{{ url('public/images/teams/') }}/<?php echo $eachTemas->image; ?>" alt="post img" class="" style="width: 100px;"></td>
                            <td>

                     
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.teams.edit', $eachTemas->id) }}">
                                       Edit
                                    </a>
                
                                    <form action="{{ route('admin.teams.deletes') }}" method="get" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="get">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{ $eachTemas->id }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                           
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination pull-right">
    {{ $teams->render() }} 
</div>
    </div>
</div>

@endsection