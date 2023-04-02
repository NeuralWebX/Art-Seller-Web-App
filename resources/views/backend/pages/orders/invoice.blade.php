<!DOCTYPE html>
<html>

<head>
    <title>POS Slip</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .container {
            border: 1px solid #ccc;
            padding: 10px;
            max-width: 300px;
            margin: 0 auto;
        }

        .title {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }

        .label {
            font-weight: bold;
            flex-basis: 70px;
        }

        .value {
            flex-basis: 200px;
            text-align: right;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 10px;
        }

        .table th,
        .table td {
            border: 1px solid #ccc;
            padding: 5px;
            text-align: center;
        }

        .table th {
            background-color: #eee;
            font-weight: bold;
        }

        .footer {
            font-size: 10px;
            margin-top: 10px;
            text-align: center;
        }

        .signature {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="title">Invoice/Bill of ArtSeller</div>
        <div class="row">
            <div class="label">Number:</div>
            <div class="value">{{ $order->order_number }}</div>
        </div>
        <div class="row">
            <div class="label">Date:</div>
            <div class="value">{{ $order->created_at->format('y-m-d') }}</div>
        </div>
        <div class="row">
            <div class="label">Sold By:</div>
            <div class="value">ArtSeller,Uttara, Dhaka-1230</div>
        </div>
        <div class="row">
            <div class="label">Payment Status:</div>
            <div class="value">Pending</div>
        </div>
        <div class="row">
            <div class="label">Payment Method:</div>
            <div class="value"></div>
        </div>
        <div class="row">
            <div class="label">Transaction ID:</div>
            <div class="value"></div>
        </div>
        <div class="row">
            <div class="label">Address:</div>
            <div class="value">{{ $order->address }}</div>
        </div>
        <div class="row">
            <div class="label">Email:</div>
            <div class="value">{{ $order->email }}</div>
        </div>
        <div class="row">
            <div class="label">Phone:</div>
            <div class="value">{{ $order->phone }}</div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ITEM</th>
                    <th>QTY.</th>
                    <th>UNIT PRICE (BDT.)</th>
                    <th>SUB TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $order->orderDetails[0]->product->product_number }}</td>
                    <td><a href="{{ route('backend.product.show',$order->orderDetails[0]->product->id) }}">{{
                            $order->orderDetails[0]->product->product_name
                            }}</a></td>
                    <td>1</td>
                    <td>{{ $order->orderDetails[0]->product->product_price }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total Amount :</td>
                    <td>194.30 Taka Only</td>
                </tr>
            </tfoot>
        </table>
        <div class="declaration">
            We declare that this invoice shows the actual price of the goods described above and that all particulars
            are true
            and correct. The goods sold are intended for end user consumption and not for resale. * This is a computer
            generated
            invoice and does not require a physical signature
        </div>
        <div class="footer">
            ArtSeller Sales Team<br>
            ArtSeller.com
        </div>
        <div class="signature">
            Authorized Signature
        </div>
    </div>
</body>

</html>