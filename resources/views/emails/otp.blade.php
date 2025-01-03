<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your OTP - {{ config('app.name') }}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    {{-- <img src="https://yourdomain.com/images/favicon.png" alt="Logo"> --}}


    <!-- External Font (for better typography) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f4f8;
            color: #333;
            padding: 20px;
            margin: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .email-header {
            margin-bottom: 20px;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 20px;
        }
        .email-header h1 {
            color: #4CAF50;
            font-size: 28px;
            margin: 0;
        }
        .email-body {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .otp-container {
            background-color: #f4f7fa;
            border-radius: 5px;
            padding: 20px;
            font-size: 36px;
            font-weight: bold;
            color: #4CAF50;
            margin-top: 20px;
            display: inline-block;
            border: 1px solid #ddd;
        }
        .site-info {
            background-color: #e9ecef;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 14px;
            color: #555;
            border: 1px solid #ddd;
        }
        .email-footer {
            font-size: 14px;
            color: #777;
            margin-top: 30px;
            border-top: 2px solid #e0e0e0;
            padding-top: 20px;
        }
        .email-footer a {
            color: #4CAF50;
            text-decoration: none;
        }
        .email-footer a:hover {
            text-decoration: underline;
        }
        .email-footer .support {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
        .support i {
            font-size: 16px;
            color: #4CAF50;
        }
        .email-footer .support a {
            display: flex;
            align-items: center;
        }
        .email-header img {
            max-width: 120px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        @if(Session::has('success'))
            <div class="mb-4 p-4 bg-green-50 text-green-800 rounded border border-green-200">
                {{ session('success') }}
            </div>
        @endif
        @if(Session::has('error'))
            <div class="mb-4 p-4 bg-red-50 text-red-800 rounded border border-red-200">
                {{ session('error') }}
            </div>   
        @endif
        <div class="email-header">
            <img src="{{ asset('images/favicon.png') }}" alt="Logo">
            <h1>Your OTP Code for {{ config('app.name') }}</h1>
        </div>
        <div class="email-body">
            <p>Hi there,</p>
            <p>Thank you for registering with us! To complete your registration process, please use the following OTP code:</p>
            <div class="otp-container">
                <span>{{ $otp }}</span>
            </div>
            <p>This code will expire in 5 minutes. Please use it promptly to complete your registration.</p>
        </div>
        <div class="site-info">
            <p><strong>{{ config('app.name') }}</strong> is an online platform that offers various quizzes and challenges to test your knowledge. Stay tuned for more features coming soon!</p>
        </div>
        <div class="email-footer">
            <p>If you didn’t request this code, please ignore this email or <span class="support"><i class="fa fa-envelope"></i><a href="mailto:support@example.com">contact support</a></span>.</p>
        </div>
    </div>
</body>
</html>