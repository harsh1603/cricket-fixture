@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Generate New Bill
    </div>

    <div class="card-body">

        <div class="row">
            <div class="form-group {{ $errors->has('company_id') ? 'has-error' : '' }} col-md-6">
                <label for="name">Company*</label>
                <select name="company_id" id="company_id" class="form-control" required>

                    <option value="">Select Company</option>
                    @foreach(getCompany() as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} col-md-6">
                <label for="name">Date*</label>
                <input type="date" id="created_date" name="created_date" class="form-control" required>


            </div>
        </div>
    </div>
</div>
<div class="card ">
    <div class="card-body">
        <div class="row">

            <div class="col-md-10">
                <select name="product" id="product" class="form-control select2">
                    <option value="">Select Product</option>
                    @foreach(getProduct() as $value)
                    <option value="{{$value->product_code}}">{{$value->name}} ({{$value->product_code}})</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <button type="btn" class="btn btn-info btn-sm" onclick="getResult('old')">update</button>
                <button type="btn" class="btn btn-success btn-sm" onclick="getResult('new')">Add New</button>

            </div>

        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <table border="1" width="100%" id="myTable">
                    <thead>
                        <tr>

                            <th>Product Name</th>
                            <th>Code</th>
                            <th>Brand</th>

                            <th>Rate</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        <thead>
                        <tbody id=last>
                        </tbody>
                </table>
            </div>
            <div class="col-md-12 text-center d-none calculate mt-4">
                <button class="btn btn-info text-center" id="calculate" type="button">Calculate</button>
            </div>
        </div>
    </div>
</div>
<div class="card d-none" id="generatebills">
    <div class="card-body">
        <form method="POST" action="{{route('admin.savePurchaseBills')}}">
            @csrf

            <div class="row" style="border: 1px dotted gray;padding: 10px;margin-bottom: 20px;">
                <div class="col-md-12">
                    <strong> Billing Information </strong>
                </div>

                <div class="col-md-4">
                    <label>Subtotal</label>
                    <input type="hidden" name="product_name" id="product_name">
                    <input type="hidden" name="quantity" id="quantity">
                    <input type="hidden" name="cost" id="prices">
                    <input type="hidden" name="companyid" id="companyid">
                    <input type="hidden" name="createddate" id="createddate">
                    <input type="hidden" name="product_code" id="product_code">
                    <input type="hidden" name="brand" id="brand_name">
                    <input type="text" name="subtotal" id="subtotal" class="form-control" readonly>
                </div>
                <div class="col-md-4">
                    <label>Discount</label>
                    <input type="number" name="discount" id="discount" class="form-control"
                        onchange="calculatediscount(this)" value="0">
                </div>

                <div class="col-md-4">
                    <label>Grand Total</label>
                    <input type="number" name="grandtotal" id="grandtotal" class="form-control" value="" readonly>
                </div>



            </div>
            <div class="row mt-3">
                <div class="col-md-12 text-center ">
                    <button class="btn btn-success text-center" id="generate" type="sumbmit">Generate Bill</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
var page = 1;
var pro = [];

function getResult(type) {
    if(page>=15){
        alert("Only 15 Product Allowed");
            return false;
    }else{
    if (type == 'new') {
        $('#myTable > tbody:last').append(
            '<tr><td><input type="text" class="form-control" name="product_name[]"  ></td>><td><input type="text" class="form-control" name="product_code[]"  ></td><td><input type="text" class="form-control brand_name"  name="brand_name[]"   value=""></td><td><input type="number" min=0 step="0.01" name="price[]"   onchange="calculateAmt(this)" class="form-control price"  value="0"></td><td><input type="number" class="form-control qty" onchange="calculatePrice(this)"  min=0  step="0.01" name="qtys[]" value="1"></td><td><input type="number" class="form-control total" min=0 step="0.01" name="total_amt[]"  value="0"></td><td><button class="btn btn-danger btn-sm" onclick="removepro(this)">X</button></td></tr>'
        );
        page += 1;
        $(".calculate").removeClass('d-none');
        // pro.push($("#product").val());
    } else {
        if ($("#product").val() == '') {
            alert("Please select Product");
            return false;
        }

        if ($("#created_date").val() == '') {
            alert("Please select Date");
            return false;
        }
        if ($("#company_id").val() == '') {
            alert("Please select Company Name");
            return false;
        }

        if ($.inArray($("#product").val(), pro) > -1) {
            alert("This Product is already added");
            return false;
        } else {
            $.ajax({
        url: "{{ route('admin.ProductBrandName')}}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            product_code: $('#product').val(),
          
        },

        type: "post",
        dataType: "json",
        success: function(response) {
            var productid = $('#product').val();
            var product =  $("#product option:selected").text();
            var product_name = product.replace('('+productid+')','');
          
            $('#myTable > tbody:last').append(
                '<tr><td><input type="text" class="form-control" name="product_name[]" disabled value="' + product_name +
                '"></td><td><input type="text" class="form-control product_code"  name="product_code[]"  disabled value="' +
                $("#product").val() +
                '"></td><td><input type="text" class="form-control brand_name"  name="brand_name[]"   value="'+response.data.brand_name+'" disabled></td><td><input type="number" min=0 step="0.01" name="price[]"   onchange="calculateAmt(this)" class="form-control price"  value="0"></td><td><input type="number" class="form-control qty" onchange="calculatePrice(this)"  min=0  step="0.01" name="qtys[]" value="1"></td><td><input type="number" class="form-control total" min=0 step="0.01" name="total_amt[]"  value="0"></td><td><button class="btn btn-danger btn-sm" onclick="removepro(this)">X</button></td></tr>'
            );
            page += 1;
            $(".calculate").removeClass('d-none');
            pro.push($("#product").val());
        }
            });
        }
    }
    }
}

function removepro(that) {
    //console.log(page);
    if (confirm('Are you Sure ?')) {
        if (page == 2) {
            alert("Atleast one product is required");
            return false;
        }
        $(that).closest("tr").remove();
        page -= 1;
        var product_code = $(that).parent().siblings().find('.product_code').val();
        pro.splice($.inArray(product_code, pro), 1);
    }
}
$("#calculate").on('click', function() {
            var sum = 0;

            prog = $('input[name*="total_amt"]').map(function() {

                sum += parseFloat($(this).val())

            }).get().join(',');
            console.log(sum);
            product = $('input[name*="product_name"]').map(function() {

                return $(this).val()
            }).get().join(',');
                product_code = $('input[name*="product_code"]').map(function() {

                    return $(this).val()


                }).get().join(',');
                brand_name = $('input[name*="brand_name"]').map(function() {

                return $(this).val()


                }).get().join(',');
                price = $('input[name*="price"]').map(function() {

                    return $(this).val()

                }).get().join(',');
                qty = $('input[name*="qtys"]').map(function() {

                    return $(this).val()

                }).get().join(',');
                $("#product_name").val(product);
                $("#product_code").val(product_code);
                $("#brand_name").val(brand_name);
                $("#prices").val(price);
                $("#quantity").val(qty);
                $("#createddate").val($("#created_date").val());
                $("#companyid").val($("#company_id").val());
                $("#subtotal").val(Math.round(sum));
                $("#grandtotal").val(Math.round(sum));
                $("#dues_amt").val(Math.round(sum));
                $("#generatebills").removeClass('d-none');
            })

            function calculatediscount(that) {
                var subtotal = $("#subtotal").val();
                var discount = $(that).val();
                var grandtotal = (parseFloat(subtotal) - parseFloat(discount));
                $("#grandtotal").val(Math.round(grandtotal));
                $("#dues_amt").val(Math.round(grandtotal));
            }

            function getdueamount() {
                var paid_in_bank = 0;
                var paid_in_cash = 0;
                var grandtotal = parseFloat($("#grandtotal").val());
                if ($("#paid_in_bank").val() != '') {
                    paid_in_bank = parseFloat($("#paid_in_bank").val());
                }
                if ($("#paid_in_cash").val() != '') {
                    paid_in_cash = parseFloat($("#paid_in_cash").val());
                }
                var dueamt = Math.round(grandtotal - (paid_in_bank + paid_in_cash));
                $("#dues_amt").val(dueamt);
            }

            function calculatePrice(that) {
                var qty = $(that).val();
                var price = $(that).parent().siblings().find('.price').val();
                var total = price * qty;
                $(that).parent().siblings().find('.total').val(total);
            }

            function calculateAmt(that) {
                var price = $(that).val();
                var qty = $(that).parent().siblings().find('.qty').val();
                var total = price * qty;
                $(that).parent().siblings().find('.total').val(total);
            }

</script>

@endsection