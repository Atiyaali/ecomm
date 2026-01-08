<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reply from Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #eaeaea;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        h2 {
            color: #007bff;
        }
        p {
            margin-bottom: 1em;
        }
        .footer {
            font-size: 12px;
            color: #888;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hello {{ $name }},</h2>

        <p>
            {!! nl2br(e($message_body)) !!}
        </p>

        <p>Best regards,<br>
        <strong>ARAISH</strong></p>

        <div class="footer">
            This is an automated message. Please do not reply to this email directly.
        </div>
    </div>
</body>
</html>
