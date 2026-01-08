<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Successful</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 650px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.08);
        }
        .header {
            background-color: #28a745;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 25px;
            color: #333333;
        }
        .content p {
            margin-bottom: 12px;
            line-height: 1.6;
        }
        .order-box {
            background-color: #f9f9f9;
            border: 1px solid #eaeaea;
            border-radius: 6px;
            padding: 15px;
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #eaeaea;
            text-align: left;
            font-size: 14px;
        }
        th {
            background-color: #f1f1f1;
        }
        .footer {
            background-color: #f4f6f8;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #777777;
        }
        .success-icon {
            font-size: 40px;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="header">
        <div class="success-icon">✅</div>
        <h2>Payment Successful</h2>
    </div>

    <div class="content">
        <p>Hello <strong>{{ $name }}</strong>,</p>

        <p>
            Thank you for your purchase! Your payment has been successfully processed.
        </p>

        <div class="order-box">
            <p><strong>Order Number:</strong> {{ $order_number }}</p>
       <p><strong>Total Amount:</strong> {{ $totalPaidInDollars }}</p>
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $item->Product->name }}</td>
                            <td>{{ $item['quantity']}}</td>
                            <td>{{ $item->Product->price}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <p>
            If you have any questions about your order, feel free to contact our support team.
        </p>

        <p>
            Thanks again for shopping with us! <br>
            <strong>{{ config('app.name') }}</strong>
        </p>
    </div>

    <div class="footer">
        © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </div>

</div>

</body>
</html>
