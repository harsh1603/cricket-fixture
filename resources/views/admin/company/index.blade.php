@extends('layouts.admin')
@section('content')
@can('company_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.company.create") }}">
                Add New
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
      Company List
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                           Name
                        </th>
                        <th>
                      Phone No
                        </th>
                       <th>Address</th>
                        <th>
                        Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($company as $key => $eachcompany)
                        <tr data-entry-id="{{ $eachcompany->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $eachcompany->name ?? '' }}
                            </td>
                            <td>
                                {{ $eachcompany->mobile ?? '' }}
                            </td>
                            <td>
                                {{ $eachcompany->address ?? '' }}
                            </td>
                            <td>
                               
                                @can('company_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.company.edit', $eachcompany->id) }}">
                                       Edit
                                    </a>
                                @endcan
                                @can('company_delete')
                                    <form action="{{ route('admin.company.deletes') }}" method="get" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="get">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{ $eachcompany->id }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination pull-right">
    {{ $company->render() }} 
</div>
    </div>
</div>

@endsection