<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Cancelled</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff5f5;
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
        .cancel-icon {
            font-size: 60px;
            color: #dc3545;
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
            background-color: #dc3545;
            color: #fff;
            padding: 12px 24px;
            border-radius: 8px;
            transition: 0.3s;
        }
        a:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="cancel-icon">❌</div>
        <h1>Payment Cancelled</h1>
        <p>Your transaction was not completed. You can try again or go back to shopping.</p>
        <a href="{{ route('get_cart') }}">Back to Cart</a>
    </div>
</body>
</html>
