@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Generate New Taxable Bill
    </div>

    <div class="card-body">
        <div class="row">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} col-md-4">
                <label for="name">Billing Date*</label>
                <input type="date" id="created_date" name="created_date" class="form-control" required>


            </div>
            <div class="col-md-4">
                <label for="name">Product*</label>

                <select name="product" id="product" class="form-control select2">
                    <option value="">Select Product</option>
                    @foreach(getProduct() as $value)
                    <option value="{{$value->product_code}}">{{$value->name}} ({{$value->product_code}})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="name">Quantity*</label>

                <input type="number" name="qty" placeholder="Quantity" id="qty" class="form-control">
            </div>
            <div class="col-md-1">
                <button type="btn" class="btn btn-success" onclick="getResult()">Add</button>
            </div>

        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <table border="1" width="100%" id="myTable">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Code</th>
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
        <form method="POST" action="{{route('admin.taxbill.saveBills')}}">
            @csrf
            <div class="row" style="border: 1px dotted gray;padding: 10px;margin-bottom: 20px;">
                <div class="col-md-12">
                    <stong> Customer Information</stong>
                </div>

                <div class="col-md-3">
                    <label>Name</label>
                    <input type="text" name="name" id="name" maxlength="200" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label>Email Id</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label>Mobile No.</label>
                    <input type="number" name="mobile" id="mobile" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label>GST No.</label>
                    <input type="text" name="gst_no" id="mobile" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label>Address</label>
                    <textarea name="address" id="address" class="form-control" required></textarea>

                </div>
            </div>
            <div class="row" style="border: 1px dotted gray;padding: 10px;margin-bottom: 20px;">
                <div class="col-md-12">
                    <strong> Billing Information </strong>
                </div>

                <div class="col-md-4">
                    <label>Subtotal</label>
                    <input type="hidden" name="productcode" id="product_id">
                    <input type="hidden" name="quantity" id="quantity">
                    <input type="hidden" name="cost" id="prices">
                    <input type="hidden" name="billingdate" id="billingdate">
                    <input type="text" name="subtotal" id="subtotal" class="form-control" readonly>
                </div>
               
                <div class="col-md-4 ">
                    <label>CGST %</label>
                    <div class="input-group">
                    <input type="number" name="cgst_per" placeholder="CGST Percentage" class="form-control"
                       >
                        <input type="text" name="cgst_amt" id="cgst_amt" value="0" class="form-control"
                        readonly>
                        </div>
                </div>
                <div class="col-md-4">
                    <label>SGST %</label>
                    <div class="input-group">
                    <input type="number" name="sgst_per"  placeholder="SGST Percentage" class="form-control"
                       >
                    <input type="text" name="sgst_amt" id="sgst_amt" value="0" class="form-control"
                    readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Discount</label>
                    <input type="number" name="discount" id="discount" class="form-control"
                        onchange="calculatediscount(this)">
                </div>
                <div class="col-md-4">
                    <label>Grand Total</label>
                    <input type="number" name="grandtotal" id="grandtotal" class="form-control" value="" readonly>
                </div>
                <div class="col-md-4">
                    <label>Paid In Cash</label>
                    <input type="number" name="paid_in_cash" id="paid_in_cash" class="form-control"
                        onchange="getdueamount()" value="0">
                </div>
                <div class="col-md-4">
                    <label>Paid In Bank/Card</label>
                    <input type="number" name="paid_in_bank" id="paid_in_bank" class="form-control"
                        onchange="getdueamount()" value="0">
                </div>
                <div class="col-md-4">
                    <label>Dues Amount</label>
                    <input type="number" name="dues_amt" id="dues_amt" class="form-control" value="">
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

function getResult() {
    if ($("#product").val() == '') {
        alert("Please select Product");
        return false;
    }
    if ($("#qty").val() == '') {
        alert("Please select Quantity");
        return false;
    }
    if ($("#created_date").val() == '') {
        alert("Please select Billing Date");
        return false;
    }
    $.ajax({
        url: "{{ route('admin.addproduct')}}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            product: $("#product").val(),
            qty: $("#qty").val(),
            billingdate: $("#created_date").val(),
        },

        type: "post",
        dataType: "json",
        success: function(response) {
            if (response.succ) {
                var productid = $('#product').val();
                var product = $("#product option:selected").text();
                var product_name = product.replace('(' + productid + ')', '');
                $('#myTable > tbody:last').append(
                    '<tr><td><input type="text" class="form-control" name="product_name[]" disabled value="' +
                    product_name +
                    '"></td>><td><input type="text" class="form-control product_code"  name="product_code[]"  disabled value="' +
                    $("#product").val() +
                    '"></td><td><input type="number" min=0 step="0.01" name="price[]"   onchange="calculateAmt(this)" class="form-control price"  value="0"></td><td><input type="number" class="form-control qty" disabled   min=0  step="0.01" name="qtys[]" value="' +
                    $("#qty").val() +
                    '"></td><td><input type="number" class="form-control total" min=0 step="0.01" name="total_amt[]"  value="0"></td><td><button class="btn btn-danger btn-sm" onclick="removepro(this)">X</button></td></tr>'
                );
                page += 1;
                $(".calculate").removeClass('d-none');
            } else {
                alert("Out of Stock", "This product is out of stock :)", "error");
            }

        },
        error: function(response) {

        }
    });
}

function removepro(that) {
    //console.log(page);
    if (confirm('Are you Sure ?')) {
        if (page == 2) {
            alert("Sorry", "Atleast one product is required", "error");
            return false;
        }
        if ($("#created_date").val() == '') {
            alert("Please select Billing Date");
            return false;
        }
        $.ajax({
            url: "{{ route('admin.removeproduct')}}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                product: $(that).parent().siblings().find('.product_code').val(),
                qty: $(that).parent().siblings().find('.qty').val(),
                billingdate: $("#created_date").val(),
            },

            type: "post",
            dataType: "json",
            success: function(response) {
                if (response.succ) {
                    $(that).closest("tr").remove();
                    page -= 1;
                } else {
                    alert("Sorry", "error :)", "error");
                }

            },
            error: function(response) {

            }
        });
    }
}
$("#calculate").on('click', function() {
    var sum = 0;

    prog = $('input[name*="total_amt"]').map(function() {

        sum += parseFloat($(this).val())

    }).get().join(',');
    //console.log(sum);
    product = $('input[name*="product_code"]').map(function() {

        return $(this).val()


    }).get().join(',');
    price = $('input[name*="price"]').map(function() {

        return $(this).val()

    }).get().join(',');
    qty = $('input[name*="qtys"]').map(function() {

        return $(this).val()

    }).get().join(',');
    $("#product_id").val(product);
    $("#prices").val(price);
    $("#quantity").val(qty);
    $("#subtotal").val(Math.round(sum));
    // var gst = (sum * 18) / 100;
    //  $("#gst").val(gst.toFixed(2));
    var grandtotal = parseFloat(sum.toFixed(2));
    $("#grandtotal").val(Math.round(grandtotal));
    $("#dues_amt").val(Math.round(grandtotal));
    $("#generatebills").removeClass('d-none');
    $("#billingdate").val($("#created_date").val());
})

function calculatediscount(that) {
    var subtotal = $("#subtotal").val();
    var sgst = $("#sgst_amt").val();
    var cgst = $("#cgst_amt").val();
    var discount = $(that).val();
    var grandtotal = (parseFloat(subtotal) - parseFloat(discount)) + (parseFloat(sgst) + parseFloat(cgst));
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

function calculateAmt(that) {
    var price = $(that).val();
    var qty = $(that).parent().siblings().find('.qty').val();
    var total = price * qty;
    $(that).parent().siblings().find('.total').val(total);
}
$("input[name='cgst_per']").on('change',function(){

   var subtotal = $("#subtotal").val();
     var gst = ($(this).val() / 100) * subtotal;
      $("#cgst_amt").val(gst.toFixed(2));
      var sgst = $("#sgst_amt").val();
    var cgst = $("#cgst_amt").val();
    var grandtotal = (parseFloat(subtotal) + parseFloat(sgst) + parseFloat(cgst));
    $("#grandtotal").val(Math.round(grandtotal));
})
$("input[name='sgst_per']").on('change',function(){

var subtotal = $("#subtotal").val();
  var gst = ($(this).val() / 100) * subtotal;
   $("#sgst_amt").val(gst.toFixed(2));
   var sgst = $("#sgst_amt").val();
    var cgst = $("#cgst_amt").val();
    var grandtotal = (parseFloat(subtotal) + parseFloat(sgst) + parseFloat(cgst));
    $("#grandtotal").val(Math.round(grandtotal));
})
</script>

@endsection