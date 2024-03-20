<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Order</title>

    <style type="text/css">
        .center-text {
            text-align: center;
        }

        .table-borderless td,
        .table-borderless th {
            border: 0;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            color: #000;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="center-text">
        <h3>INVOICE ORDER</h3>
        <h1>MEDSHOP</h1>
        <p>Surabaya, Jawa Timur</p>
        <p>Phone: 031-7878-999 | Email: <a href="mailto:admin@medshop.com">admin@medshop.com</a></p>
    </div>
    <table style="margin-bottom: 20px;" class="table-borderless">
        <tr class="table-borderless">
            <td class="table-borderless" style="width: 50%;">
                <div>
                    <p>To:</p>
                    <p><strong>{{ $order->name }}</strong></p>
                    <p>{{ $order->address_delivery }}</p>
                </div>
            </td>
        </tr>
    </table>
    <table class="center-text" style="margin-bottom: 20px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $order->product_name }}</td>
                <td>Rp. {{ number_format($order->price, 0, ',', '.') }}</td>
                <td>{{ $order->quantity }}</td>
                <td class="text-right text-secondary">Rp.
                    {{ number_format($order->price * $order->quantity, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    <div style="width: 200px; height: 140px; text-align: center; float: right;">
        <p>Surabaya, {{ date('d-m-Y') }}</p>

        <br><br><br>

        <p>________________________</p>

        <p>Medshop</p>
    </div>
    <div style="clear: both;"></div>
    <div class="footer">
        <p>dicetak pada: {{ date('d-m-Y H:i:s') }}</p>
    </div>
</body>

</html>
