<!DOCTYPE html>
<html>
<head>
    <title>Edit Grade</title>
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
        p {
            font-size: 18px;
            color: #555;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
            text-align: left;
        }
        label {
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Edit Grade</h1>
    <p>Student: {{ $grade->student->user->name }}</p>
    <p>Course: {{ $grade->course->name }}</p>
    <form action="{{ route('teacher.updateGrade', $grade->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="score">Score:</label>
        <input type="number" id="score" name="score" value="{{ $grade->score }}" required><br><br>
        <label for="grade">Grade:</label>
        <input type="text" id="grade" name="grade" value="{{ $grade->grade }}" required><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
