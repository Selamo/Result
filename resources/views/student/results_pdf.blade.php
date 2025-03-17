<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1, h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
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
    <h1>My Results</h1>
    <h2>Student: {{ Auth::user()->name }}</h2> <!-- Display student name -->

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

</body>
</html>
