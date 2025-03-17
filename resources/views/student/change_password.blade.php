<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .change-password-container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }
        .change-password-container h1 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="change-password-container">
        <h1>Change Password</h1>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('student.changePassword') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="current_password">Current Password:</label>
                <input type="password" id="current_password" name="current_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="new_password_confirmation">Confirm New Password:</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Change Password</button>
        </form>
    </div>
</body>
</html>
