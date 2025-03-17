<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Results</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #eef2f7;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }
        .header {
            width: 100%;
            background: #fff;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header .student-name {
            font-size: 20px;
            font-weight: bold;
        }
        .header .actions {
            display: flex;
            gap: 10px;
        }
        .container {
            background: #fff;
            width: 60%;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 26px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow: hidden;
            border-radius: 8px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 14px;
            text-align: center;
            font-size: 16px;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        tr:hover {
            background-color: #e2e6ea;
            transition: 0.3s;
        }
        .btn {
            display: inline-block;
            padding: 12px 18px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s ease-in-out;
            margin: 10px;
            font-size: 14px;
        }
        .logout-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
        .download-link, .change-password-link {
            background-color: #007bff;
            color: white;
        }
        .download-link:hover, .change-password-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="student-name">
            @auth
            <div class="d-flex align-items-center">
                <a href="{{ route('profile.picture.edit') }}">
                    @if(Auth::user()->profile_picture)
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                             alt="Profile Picture" class="rounded-circle me-2" width="40" height="40" style="cursor: pointer;">
                    @else
                        <img src="https://via.placeholder.com/40" alt="Default Icon"
                             class="rounded-circle me-2" width="40" height="40" style="cursor: pointer;">
                    @endif
                </a>
                <span class="text-white me-2">{{ Auth::user()->name }}</span> <!-- Display Name -->
            </div>
        @endauth
            Welcome, {{ Auth::user()->name }}
        </div>
        <div class="actions">
            <a href="{{ route('student.showChangePasswordForm') }}" class="btn change-password-link">Change Password</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <div class="container">
        <h1>My Results</h1>

        <a href="{{ route('student.downloadResults') }}" class="btn download-link">Download Results as PDF</a>

        <table>
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Score</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grades as $grade)
                    <tr>
                        <td>{{ $grade->course->name }}</td>
                        <td>{{ $grade->score }}</td>
                        <td>{{ $grade->grade }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
