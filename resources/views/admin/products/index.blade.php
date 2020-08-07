@extends('layouts.admin')
@section('content')
@can('product_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.products.create") }}">
            {{ trans('global.add') }} {{ trans('global.product.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
       Upload New Product
    </div>

    <div class="card-body">
   
        <form action="{{ route("admin.products.importProduct") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
        <div class="col-md-2">
        <a href="{{ asset('public/product.xlsx') }}" target="blank" title="download format"><i class="fa fa-wpforms" aria-hidden="true"></i>
</a>
        </div>
        <div class="col-md-6">
        <input type="file" class="form-control" name="pro_import" required>
        </div>
        <div class="col-md-4">
        <button type="submit" class="btn btn-success">Upload</button>
        </div>
        </div>
        </form>
        
       
    </div>
    </div>
<div class="card">
    <div class="card-header">
        {{ trans('global.product.title_singular') }} {{ trans('global.list') }}
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
                            {{ trans('global.product.fields.name') }}
                        </th>
                        <th>
                            Product Code
                        </th>
                        <th>
                            Company Name
                        </th>
                        <th>
                            Brand Name
                        </th>
                        <th>Quantity</th>
                        <th>Price</th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $qty=0;
                    $price=0;
                    @endphp
                    @foreach($products as $key => $product)
                    @php
                    $qty += getProductOption('qty',$product->id);
                    $price +=getProductOption('qty',$product->id) * getProductOption('dp',$product->id);
                    @endphp
                    <tr data-entry-id="{{ $product->id }}">
                        <td>
                            {{$key+1}}
                        </td>
                        <td>
                            {{ $product->name ?? '' }}
                        </td>
                        <td>
                            {{ $product->product_code ?? '' }}
                        </td>
                        <td>
                            {{getCompanyName('name',$product->company_id)??''}}
                        </td>
                        <td>{{$product->brand_name}}</td>
                        <td>{{getProductOption('qty',$product->id)}}</td>
                        <td>{{getProductOption('qty',$product->id) * getProductOption('dp',$product->id)}}</td>
                        <td>
                            @can('product_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.products.show', $product->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan
                            @can('product_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.products.edit', $product->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan
                            @can('product_delete')
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                            </form>
                            @endcan
                        </td>

                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5">Total</th>
                        <th>{{$qty}}</th>
                        <th>{{$price}}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="pagination ">
            {{ $products->render() }}
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
$(function() {
    let deleteButtonTrans = '{{ trans('
    global.datatables.delete ') }}'
    let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('admin.products.massDestroy') }}",
        className: 'btn-danger',
        action: function(e, dt, node, config) {
            var ids = $.map(dt.rows({
                selected: true
            }).nodes(), function(entry) {
                return $(entry).data('entry-id')
            });

            if (ids.length === 0) {
                alert('{{ trans('
                    global.datatables.zero_selected ') }}')

                return
            }

            if (confirm('{{ trans('
                    global.areYouSure ') }}')) {
                $.ajax({
                        headers: {
                            'x-csrf-token': _token
                        },
                        method: 'POST',
                        url: config.url,
                        data: {
                            ids: ids,
                            _method: 'DELETE'
                        }
                    })
                    .done(function() {
                        location.reload()
                    })
            }
        }
    }
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    @can('product_delete')
    dtButtons.push(deleteButton)
    @endcan

    $('.datatable:not(.ajaxTable)').DataTable({})
})
</script>
@endsection
@endsection