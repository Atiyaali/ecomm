<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f9f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        .success-icon {
            font-size: 60px;
            color: #28a745;
        }
        h1 {
            color: #333;
        }
        p {
            color: #555;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background-color: #28a745;
            color: #fff;
            padding: 12px 24px;
            border-radius: 8px;
            transition: 0.3s;
        }
        a:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-icon">✔️</div>
        <h1>Order Successful!</h1>
        <p>Thank you for your Order. Your Order has been completed successfully.</p>
        <a href="{{ url('/') }}">Go to Home</a>
    </div>
</body>
</html>
