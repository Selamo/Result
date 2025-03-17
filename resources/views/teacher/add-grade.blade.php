<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Grade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Add Grade</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('teacher.storeGrade') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="student_id" class="form-label">Student:</label>
                        <select id="student_id" name="student_id" class="form-select" required>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="course_id" class="form-label">Course:</label>
                        <select id="course_id" name="course_id" class="form-select" required>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="score" class="form-label">Score:</label>
                        <input type="number" id="score" name="score" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="grade" class="form-label">Grade:</label>
                        <input type="text" id="grade" name="grade" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Add Grade</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
