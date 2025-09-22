<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email Address</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: none;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #3b82f6; /* A nice blue color */
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
            text-align: center;
            color: #4b5563;
        }
        .content h2 {
            font-size: 20px;
            color: #1f2937;
        }
        .button-container {
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            background-color: #3b82f6;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: bold;
        }
        .footer {
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
        }
        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Email Verification</h1>
        </div>
        <div class="content">
            <h2>Hello there!</h2>
            <p>
                Thank you for registering with our service. Please click the button below to verify your email address. This link is valid for <strong>60 minutes</strong>.
            </p>
            <div class="button-container">
                <a href="{{ $url }}" class="button">Verify Email Address</a>
            </div>
            <p style="margin-top: 25px;">
                If you did not create an account, no further action is required.
            </p>
            <p>
                If you are having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser:
            </p>
            <p style="word-wrap: break-word;">
                <a href="{{ $url }}">{{ $url }}</a>
            </p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Travel booking. All rights reserved.</p>
        </div>
    </div>
</body>
</html>