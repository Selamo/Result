<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management System</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <!-- Styles -->
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }
        .buttons a {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            color: #fff;
            background-color: #007bff;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
            margin: 0.5rem;
        }
        .buttons a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the School Management System</h1>
        <p>Please select your login type:</p>
        <div class="buttons">
            <a href="{{ route('login') }}">Student Login</a>
            <a href="{{ route('login') }}">User Login</a>
        </div>
    </div>
</body>
</html>
