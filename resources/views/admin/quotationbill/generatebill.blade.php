<html>

<head>
    <title>Purchase Bill</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <style type="text/css">
    * {
        margin: 0;
        padding: 0;
    }

    html,
    body {
        height: 100%;
        overflow: hidden;
    }

    #printarea {
        position: absolute;
        overflow: auto;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        border: 4px solid #4141e5;
    }

    .billborder {
        border: 1px solid #4141e5
    }

    .eshead {
        background-color: #4141e5;
        color: white;
        padding: 3px;
        font-size: 18px;
        font-weight: 800;
    }

    .colorblue {
        color: #4141e5;
    }

    .dottedborder {
        border-bottom: 1px dotted #4141e5;
    }

    #product>tbody>tr {
        height: 35px;
    }

    .watermark {
        display: none;
    }

    @media print {
        .watermark {
            display: inline;
            position: fixed !important;
            opacity: 0.25;
            font-size: 3em;
            width: 100%;
            text-align: center;
            z-index: 1000;
            top: 400px;
            right: 5px;
        }
    }
    </style>
</head>

<body onload="printDiv('printarea')">
    @php $logo = asset('public/images/logo.png'); @endphp
    <div id="printarea">
        <div class="watermark"><img src="{{$logo}}" alt="Furniture town"></div>

        <table style="width: 100%;margin-bottom:6px;">
            <thead>
                <tr style=" border: 0px solid #000;">
                    <th style=" border: 0px solid #ddd;text-align: left;width:30%;">

                    </th>
                    <th style=" border: 0px solid #ddd;text-align: center;width:30%;">
                        <span class="eshead"> Quotation </span>
                    </th>
                    <th style=" border: 0px solid #ddd;text-align: right;width:40%;">
                        <span class="colorblue"> Mob. {{$setting->mobile}} </span>
                    </th>
                </tr>
            </thead>
        </table>
        <table style="width: 100%;margin-bottom:6px;">
            <thead>
                <tr style=" border: 0px solid #000;">
                    <th style=" border: 0px solid #ddd;text-align: left;width:30%;">

                    </th>
                    <th style=" border: 0px solid #ddd;text-align: center;">
                        <img src="{{$logo}}" style="width:80px;" alt="Furniture town">
                    </th>
                    <th style=" border: 0px solid #ddd;text-align: right;width:40%;">

                    </th>
                </tr>
            </thead>
        </table>
        <table style="width: 100%;margin-bottom:6px;">
            <thead>
                <tr style=" border: 0px solid #000;">
                    <th style=" border: 0px solid #ddd;text-align: center;">
                       
                        <span class="colorblue">H.O. : {{$setting->address}}</span><br>
                    </th>

                </tr>
            </thead>
        </table>
        <table style="width: 100%;margin-bottom:6px;">
            <thead>
                <tr style=" border: 0px solid #000;">
                    <th style=" border: 0px solid #ddd;text-align: left;width:30%;">
                        <span class="colorblue">Invoice No. :- </span><span>{{$data->invoice_no}}</span>
                    </th>
                    <th style=" border: 0px solid #ddd;text-align: center;width:30%;">

                    </th>
                    <th style=" border: 0px solid #ddd;text-align: right;width:40%;">
                        <span class="colorblue"> Date :- </span><span
                            class="dottedborder">{{date('d/m/Y',strtotime($data->billing_date))}}</span>
                    </th>
                </tr>
            </thead>
        </table>
        <table style="width: 100%;margin-bottom:20px;">
            <thead>
                <tr style=" border: 0px solid #000;">
                    <td style=" border: 0px solid #ddd;text-align: left;width:10%">
                        <span class="colorblue"><b>Purchaser's Name</b></span><br>

                    </td>
                    <td style=" border: 0px solid #ddd;text-align: left;border-bottom: 1px dotted #4141e5;">
                  {{$data->name}}

                    </td>
                </tr>
                <tr style=" border: 0px solid #000;">
                    <td style=" border: 0px solid #ddd;text-align: left;width:10%">

                        <span class="colorblue"><b>GST No. </b></span><br>

                    </td>
                    <td style=" border: 0px solid #ddd;text-align: left;border-bottom: 1px dotted #4141e5;">
                        

                    </td>
                </tr>
                <tr style=" border: 0px solid #000;">
                    <td style=" border: 0px solid #ddd;text-align: left;width:10%">

                        <span class="colorblue"><b>Address</b></span><br>

                    </td>
                    <td style=" border: 0px solid #ddd;text-align: left;border-bottom: 1px dotted #4141e5;">
                    {{$data->address}}

                    </td>
                </tr>
                <tr style=" border: 0px solid #000;">
                    <td style=" border: 0px solid #ddd;text-align: left;width:10%">

                        <span class="colorblue"><b>Phone</b></span><br>
                    </td>
                    <td style=" border: 0px solid #ddd;text-align: left;border-bottom: 1px dotted #4141e5;">
                    {{$data->mobile}}

                    </td>
                </tr>
            </thead>
        </table>
        <table style="width: 100%;border: 1px solid #4141e5;border-collapse: collapse;" id="product">
            <thead>

                <tr style="border: 1px solid #4141e5;border-collapse: collapse;">
                    <th style="border: 1px solid #4141e5;border-collapse: collapse;width:2%;color:#4141e5;">
                        Sl.No

                    </th>
                    <th style="border: 1px solid #4141e5;border-collapse: collapse;width:50%;color:#4141e5;">
                        Description of Goods

                    </th>
                    <th style="border: 1px solid #4141e5;border-collapse: collapse;width:10%;color:#4141e5;">
                        Code

                    </th>
                    <th style="border: 1px solid #4141e5;border-collapse: collapse;width:10%;color:#4141e5;">
                        Quantity

                    </th>
                    <th style="border: 1px solid #4141e5;border-collapse: collapse;width:13%;color:#4141e5;">
                        Rate

                    </th>
                    <th style="border: 1px solid #4141e5;border-collapse: collapse;width:15%;color:#4141e5;">
                        Amount

                    </th>
                </tr>
            </thead>
            <tbody>
                @php $counttotal = count($data['billsmeta']); @endphp
                @foreach($data['billsmeta'] as $key => $value)

                <tr style=" border: 0px solid #000;">
                    <td style="border-right: 1px solid #4141e5;border-collapse: collapse;text-align: center;width:2%;">
                        {{$key+1}}
                    </td>
                    <td
                        style="border-right: 1px solid #4141e5;border-collapse: collapse;text-align: left;width:50%;padding:6px;">
                        {{getProductNameByCode('name',$value->product_code)}}</td>
                    <td style="border-right: 1px solid #4141e5;border-collapse: collapse;text-align: center;width:10%;">
                        {{getProductNameByCode('product_code',$value->product_code)}}</td>
                    <td style="border-right: 1px solid #4141e5;border-collapse: collapse;text-align: center;width:10%;">
                        {{$value->qty}}</td>
                    <td style="border-right: 1px solid #4141e5;border-collapse: collapse;text-align: center;width:13%">
                        {{$value->price}}</td>
                    <td style="border-right: 1px solid #4141e5;border-collapse: collapse;text-align: center;width:15%">
                        {{$value->price*$value->qty}}</td>
                </tr>
                @endforeach
                @if($counttotal<=15) @for($i=0;$i<=15-$counttotal;$i++) <tr style=" border: 0px solid #000;">
                    <td style="border-right: 1px solid #4141e5;border-collapse: collapse;text-align: center;width:2%;">
                    </td>
                    <td
                        style="border-right: 1px solid #4141e5;border-collapse: collapse;text-align: left;width:50%;padding:6px;">
                    </td>
                    <td style="border-right: 1px solid #4141e5;border-collapse: collapse;text-align: center;width:10%;">
                    </td>
                    <td style="border-right: 1px solid #4141e5;border-collapse: collapse;text-align: center;width:10%;">
                    </td>
                    <td style="border-right: 1px solid #4141e5;border-collapse: collapse;text-align: center;width:13%">
                    </td>
                    <td style="border-right: 1px solid #4141e5;border-collapse: collapse;text-align: center;width:15%">
                    </td>
                    </tr>
                    @endfor
                    @endif

            <tfoot>
                <tr>
                    <td colspan="3" style="border: 1px solid #4141e5;border-collapse: collapse;padding:6px;">

                        Total Amount (in
                        words).....................................................................................
                    </td>
                    <td style="border: 1px solid #4141e5;border-collapse: collapse;" colspan="3">
                        <table style="border: 1px solid #4141e5;border-collapse: collapse;width: 100%;">
                            <tr style="border: 1px solid #4141e5;border-collapse: collapse;" colspan="2">
                                <td style="border: 1px solid #4141e5;border-collapse: collapse;text-align:right;padding:6px;width: 60%;"
                                    colspan="2">Total</td>
                                <td
                                    style="border: 1px solid #4141e5;border-collapse: collapse;padding:6px; text-align:center;width: 40%;">
                                    {{$data->subtotal}}</td>
                            </tr>
                            <tr style="border: 1px solid #4141e5;border-collapse: collapse;">
                                <td style="border: 1px solid #4141e5;border-collapse: collapse;text-align:right;padding:6px;width: 60%;"
                                    colspan="2">Discount</td>
                                <td
                                    style="border: 1px solid #4141e5;border-collapse: collapse;padding:6px;text-align:center;width: 40%;">
                                    {{$data->discount}}</td>
                            </tr>
                            <tr style="border: 1px solid #4141e5;border-collapse: collapse;">
                                <td style="border: 1px solid #4141e5;border-collapse: collapse;text-align:right;padding:6px;width: 60%;"
                                    colspan="2"><b>Net Amount</b></td>
                                <td
                                    style="border: 1px solid #4141e5;border-collapse: collapse;padding:6px;text-align:center;width: 40%;">
                                    {{$data->grandtotal}}</td>
                            </tr>
                        </table>
                    </td>

                </tr>
            </tfoot>
            </tbody>

        </table>
        <table style="width: 100%;">
            <tr style="">
                <td style="text-align: right;height:50px;">
                    For <b>Furniture Town</b>
                </td>
            </tr>
            <tr style="">
                <td style="text-align: right;">
                    Authorised Signatory
                </td>
            </tr>
        </table>
    </div>
    <!-- <button onclick="printDiv('printarea')" class="btn btn-primary loginbt custm_btn">Print</button> -->
    <script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        document.title = "Purchase Bill";
        document.date = "";
        window.print();

        document.body.innerHTML = originalContents;
    }
    </script>
</body>

</html>