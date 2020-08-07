@extends('layouts.admin')
@section('content')
@can('product_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.products.price.add",[$id]) }}">
                {{ trans('global.add') }} {{ trans('global.product.title_singular') }} Price
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.product.title_singular') }} Price {{ trans('global.list') }}
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
                          Product Name
                        </th>
                        <th>
                           Created Date
                        </th>
                        <th>
                           DP
                        </th>
                      
                        
                        <th>
                           Quantity
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productmeta as $key => $product)
                        <tr data-entry-id="{{ $product->id }}">
                            <td>
                                {{$key+1}}
                            </td>
                            <td>
                            {{ getProductName('name',$product->product_id) ?? '' }}
                            </td>
                            <td>
                                {{ date('d-m-Y',strtotime($product->created_date)) ?? '' }}
                            </td>
                            <td>
                            &#x20B9; {{ $product->dp ?? '' }}
                            </td>
                           
                            <td>
                            {{ $product->qty ?? '' }}
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
    $(function () {
  

  $('.datatable:not(.ajaxTable)').DataTable({  })
})

</script>
@endsection
@endsection