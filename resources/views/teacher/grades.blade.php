<!DOCTYPE html>
<html>
<head>
    <title>Manage Grades</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f4f4f4;
            text-align: center;
        }
        h1 {
            color: #333;
        }
        a {
            display: inline-block;
            padding: 10px 15px;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        a:hover {
            background-color: #0056b3;
        }
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <h1>Manage Grades</h1>
    <a href="{{ route('teacher.createGrade') }}">Add Grade</a>
    <table>
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Course</th>
                <th>Score</th>
                <th>Grade</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grades as $grade)
                <tr>
                    <td>{{ $grade->student->user->name }}</td>
                    <td>{{ $grade->course->name }}</td>
                    <td>{{ $grade->score }}</td>
                    <td>{{ $grade->grade }}</td>
                    <td>
                        <a href="{{ route('teacher.editGrade', $grade->id) }}">Edit</a>
                        <form action="{{ route('teacher.deleteGrade', $grade->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
