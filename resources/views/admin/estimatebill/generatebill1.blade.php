<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
    .center {
        text-align: center;
    }

    table {
        border-collapse: collapse;
    }

    th {
        height: 30px;
        font-size: 13px;
    }

    td {
        font-size: 12px;
    }

    footer .pagenum:before {
        content: counter(page);
    }

    @page {
        margin: 100px 25px;
    }

    header {
        position: fixed;
        top: -120px;
        left: 0px;
        right: 0px;
        bottom: 60px;
    }

    .pagenum-container {
        text-align: center;
    }

    footer {
        position: fixed;
        bottom: -40px;
        left: 0px;
        right: 0px;
    }

    body {
        border: 1px solid gray;
    }
    </style>
</head>

<body>

    <main style="">
        <table style="width: 100%;margin-bottom:6px;">
            <thead>
                @php $logo = asset('public/images/logo.png'); @endphp
                <tr style=" border: 0px solid #000;">
                    <th style=" border: 0px solid #ddd;text-align: left;padding-left: 15px;">
                        <img src="{{ $logo }}" style="width:80px;" alt="Furniture town">
                    </th>



                    <th style=" border: 0px solid #ddd;text-align: right;">
                        <h3 style="color:gray;font-size:18px;">ESTIMATE</h3><br>

                    </th>


                </tr>

            </thead>
        </table>
        <div style="position: relative;margin-top:20px;margin-bottom:90px; ">

            <div style="width: 60%;position: absolute;left: 0;top: 0; margin-bottom: 40px;padding-left: 15px;">
                {{$setting->company_name}}<br>
                Address :- {{$setting->address}}<br>
                Mobile No. :-{{$setting->mobile}}<br>
                Email :-{{$setting->email}}
            </div>
            <div style="width: 30%;position: absolute;right: 0;top: 0;margin-bottom: 20px;">
                <table style="width:100%">
                    <thead>
                        <tr style=" border: 1px solid #000;">
                            <th
                                style=" border: 1px solid #3d6268;background: #c4d3d5;text-align: center;text-align: center;">
                                Invoice No</th>
                            <th
                                style=" border: 1px solid #3d6268;background: #c4d3d5;text-align: center;text-align: center;">
                                Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style=" border: 1px solid #000;text-align: center;">{{@$data->invoice_no}}</td>
                            <td style=" border: 1px solid #000;text-align: center;">{{@date('d-m-Y',strtotime($data->created_at))}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div style="position:relative;">
            <div style="width: 35%;margin-top: 90px;position: absolute;left: 0;top: 0; padding-left: 15px;">
                <table style="width:100%">
                    <thead>
                        <tr style=" border: 1px solid #000;">
                            <th
                                style=" border: 1px solid #3d6268;background: #c4d3d5;height: 30px;text-align: center;text-align: center;">
                                Client Details</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style=" "><span style="float:left;">Name :</span><span
                                    style="float:right;">{{@$data->name}}</span><br>
                                <span style="float:left;">Email :</span><span
                                    style="float:right;">{{@$data->email}}</span><br>
                                <span style="float:left;">Mobile No. :</span><span
                                    style="float:right;">{{@$data->mobile}}</span><br>
                                <span style="float:left;">Address :</span><span style="float:right;">{{@$data->address}}</span><br>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="width: 40%;margin-top: 0px;position: absolute;right: 0;top: 0;">
                <table style="width:100%">
                    <thead>
                        <tr style=" border: 1px solid #000;">
                            <th
                                style=" border: 1px solid #3d6268;background: #c4d3d5;text-align:height: 30px; center;text-align: center;">
                                Executive</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style=""><span style="float:left;">Bill By :</span><span{}
                                    style="float:right;">{{getUserName($data->created_by)}}</span><br>
                                <span style="float:left;">Sale By :</span><span style="float:right;">{{getUserName($data->created_by)}}</span><br>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div style="margin-top:200px;">
            <table style="width:100%;margin-top:200px;">
                <thead>
                    <tr style=" border: 1px solid #000;">
                        <th
                            style=" border: 1px solid #3d6268;background: #c4d3d5;text-align:height: 30px; center;text-align: center;">
                            S.no</th>
                        <th
                            style=" border: 1px solid #3d6268;background: #c4d3d5;text-align:height: 30px; center;text-align: center;">
                            Product Name</th>
                        <th
                            style=" border: 1px solid #3d6268;background: #c4d3d5;text-align:height: 30px; center;text-align: center;">
                            Product Code</th>
                        <th
                            style=" border: 1px solid #3d6268;background: #c4d3d5;text-align:height: 30px; center;text-align: center;">
                            Quantity</th>
                        <th
                            style=" border: 1px solid #3d6268;background: #c4d3d5;text-align:height: 30px; center;text-align: center;">
                            Unit Rate</th>
                        <th
                            style=" border: 1px solid #3d6268;background: #c4d3d5;text-align:height: 30px; center;text-align: center;">
                            Amount</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['billsmeta'] as $key => $value)
                    <tr>
                        <td style=" border: 1px solid #000;text-align: center;">{{$key+1}}</td>
                        <td style=" border: 1px solid #000;text-align: center;">{{getProductName('name',$value->product_id)}}</td>
                        <td style=" border: 1px solid #000;text-align: center;">{{getProductName('product_code',$value->product_id)}}</td>
                        <td style=" border: 1px solid #000;text-align: center;">{{$value->qty}}</td>
                        <td style=" border: 1px solid #000;text-align: center;"><span
                                style="font-family: DejaVu Sans; sans-serif;">&#x20B9;</span> {{$value->price}}</td>
                        <td style=" border: 1px solid #000;text-align: center;"><span
                                style="font-family: DejaVu Sans; sans-serif;">&#x20B9;</span> {{$value->price}}</td>
                    </tr>
                   @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            <p>
                                Term & Conditions<br>
                                1.Gst 18% Extra<br>
                                2.Gst 18% Extra<br>
                                3.Gst 18% Extra<br>
                                4.Gst 18% Extra<br>
                                5.Gst 18% Extra

                            </p>
                        </td>
                        <td style=" border: 1px solid #000;text-align: center;">
                        <table border="1" style="width:100%">
                    <tr style=" border: 1px solid #000;text-align: center;">
                        <th>SUBTOTAL</th>
                        <td><span style="font-family: DejaVu Sans; sans-serif;">&#x20B9;</span> {{@$data->subtotal}}</td>
                    </tr>
                    <tr style=" border: 1px solid #000;text-align: center;">
                        <th>DISCOUNT</th>
                        <td><span style="font-family: DejaVu Sans; sans-serif;">&#x20B9;</span> {{@$data->discount}}</td>
                    </tr>
                    <tr style=" border: 1px solid #000;text-align: center;">
                        <th>GST</th>
                        <td><span style="font-family: DejaVu Sans; sans-serif;">&#x20B9;</span> {{@$data->gst_amt}}</td>
                    </tr>
                    <tr style=" border: 1px solid #000;text-align: center;">
                        <th>PAID IN CASH</th>
                        <td><span style="font-family: DejaVu Sans; sans-serif;">&#x20B9;</span> {{@$data->paid_by_cash}}</td>
                    </tr>
                    <tr style=" border: 1px solid #000;text-align: center;">
                        <th>PAID IN BANK/CARD</th>
                        <td><span style="font-family: DejaVu Sans; sans-serif;">&#x20B9;</span> {{@$data->paid_by_bank}}</td>
                    </tr>
                    <tr style=" border: 1px solid #000;text-align: center;">
                        <th>TOTAL PAID</th>
                        <td><span style="font-family: DejaVu Sans; sans-serif;">&#x20B9;</span> {{@$data->grandtotal}}</td>
                    </tr>
                    <tr style=" border: 1px solid #000;text-align: center;">
                        <th>DUE AMOUNT</th>
                        <td><span style="font-family: DejaVu Sans; sans-serif;">&#x20B9;</span> {{@$data->due_amt}}</td>
                    </tr>
                    </table>
                    </td>
                        </tr>
                </tfoot>
            </table>
        </div>

    </main>

</body>

</html>