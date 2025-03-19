<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload XLS File</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            background-color: #fdfdfd;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #ffffff;
            padding: 25px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px;
        }
        h2 {
            font-size: 22px;
            color: #333;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        p {
            font-size: 16px;
            padding: 8px;
            border-radius: 3px;
        }
        .success {
            color: green;
            background: #e6f9e6;
            border: 1px solid #c3e6cb;
        }
        .error {
            color: red;
            background: #fde8e8;
            border: 1px solid #f5c6cb;
        }
        input[type="file"] {
            border: 1px solid #ccc;
            padding: 6px;
            width: 100%;
            margin-bottom: 15px;
            font-size: 16px;
        }
        button {
            background: #004085;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 3px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            display: block;
            width: 100%;
        }
        button:hover {
            background: #002752;
        }
        .dashboard-btn {
            background: #333;
            margin-top: 15px;
        }
        .dashboard-btn:hover {
            background: #222;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Upload XLS to Create Users</h2>

        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        @if(session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif

        <form action="{{ route('admin.grades.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" required>
            <button type="submit">Upload</button>
        </form>

        <!-- Button to Admin Dashboard -->
        <a href="{{ route('admin.dashboard') }}">
            <button class="dashboard-btn">Go to Admin Dashboard</button>
        </a>
    </div>
</body>
</html>
