@extends('layouts.admin')
@section('content')
@can('bill_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.taxbill.add") }}">
            Generate New Bill
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        Bill List
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
                            Invocie No.
                        </th>
                        <th>
                            Total Amount
                        </th>
                        <th>
                            Due Amount
                        </th>
                        <th>
                            Billing Date
                        </th>
                        <th>
                            Generated By
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bills as $key => $bill)
                    <tr data-entry-id="{{ $bill->id }}">
                        <td>
                            {{$key+1}}
                        </td>
                        <td>
                            {{ $bill->invoice_no ?? '' }}
                        </td>
                        <td>
                            {{ $bill->grandtotal ?? '' }}
                        </td>
                        <td>
                        <span>&#8377;</span>  {{$bill->due_amt??''}}
                        </td>
                        <td>
                            {{ date('d/m/Y',strtotime($bill->billing_date)) ?? '' }}
                        </td>
                        <td>
                            {{ getUserName($bill->created_by) ?? '' }}
                        </td>
                        <td>
                         
                            @can('bill_show')
                            <a class="btn btn-xs btn-primary" title="view product list"
                                href="{{ route('admin.taxbill.show', $bill->id) }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            @endcan
                            <a class="btn btn-xs btn-success"
                                href="{{route('admin.taxbill.generateBill',[Crypt::encrypt($bill->id)])}}"
                                title="print"><i class="fa fa-print"></i> </a>
                            @can('bill_delete')
                            <form action="{{ route('admin.taxbill.destroy', $bill->id) }}" method="POST"
                                onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                style="display: inline-block;">
                                <input type="hidden" name="_method" value="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                            </form>
                            @endcan
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
$(function() {

$('.datatable:not(.ajaxTable)').DataTable({});
})
</script>
@endsection
@endsection