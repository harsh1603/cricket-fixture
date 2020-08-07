@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Product List
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">
                            S.No
                        </th>
                        <th>Product Name</th>
                        <th>Product Code</th>
                        <th>Rate</th>
                        <th>
                            Quantity
                        </th>
                        <th>
                           Amount
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
                            {{getProductName('name',$bill->product_id)}}
                        </td>
                        <td>
                        {{getProductName('product_code',$bill->product_id)}}
                        </td>
                        <td>
                            <span>&#8377;</span> {{$bill->price}}
                        </td>
                        <td>
                            <span>&#8377;</span> {{ $bill->qty ?? '' }}
                        </td>
                     
                        <td>
                            {{ $bill->total_amt ?? '' }}
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