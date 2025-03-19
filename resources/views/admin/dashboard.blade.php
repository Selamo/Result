<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
            transition: all 0.3s;
        }
        .sidebar a {
            padding: 12px 20px;
            text-decoration: none;
            font-size: 18px; /* Change font size */
            font-family: 'Verdana', sans-serif; /* Change font type */
            color: #ffffff; /* Change font color */
            display: flex;
            align-items: center;
            transition: 0.3s;
        }
        .sidebar a i {
            margin-right: 10px;
        }
        .sidebar a:hover {
            background-color: #495057;
            border-left: 4px solid #007bff;
            padding-left: 16px;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
            transition: all 0.3s;
        }
        .card {
            border: none;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }
        .card-title {
            font-size: 22px;
            font-weight: bold;
        }
        .card p {
            font-size: 18px;
            margin: 0;
        }
        .top-bar {
            background: #fff;
            padding: 15px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .top-bar h1 {
            font-size: 24px;
            margin: 0;
        }
        .logout-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: 0.3s;
        }
        .logout-btn:hover {
            background: #c82333;
        }
        .header {
            background-color: #343a40;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header .logo {
            font-size: 24px;
            font-weight: bold;
            font-family: 'Verdana', sans-serif; /* Change font type */
        }
        .header .nav-links a {
            color: #ffffff; /* Change font color */
            margin-left: 20px;
            text-decoration: none;
            font-size: 18px; /* Change font size */
            font-family: 'Verdana', sans-serif; /* Change font type */
        }
        .header .nav-links a:hover {
            text-decoration: underline;
        }
        .card:hover {
            transform: scale(1.05);
            transition: 0.3s ease-in-out;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }
            .content {
                margin-left: 210px;
            }

        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <div class="logo">Admin Dashboard</div>
        <div class="nav-links">
            <a href="{{ route('admin.dashboard') }}">Home</a>
            <a href="{{ route('admin.showRegisterStudentForm') }}">Register Student</a>
            <a href="{{ route('admin.showAddCourseForm') }}">Add Course</a>
            <a href="{{ route('admin.showRegisterTeacherForm') }}">Register Teacher</a>
            <a href="{{ route('teacher.showGrades') }}">Manage Grades</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        </div>
    </div>

    <!-- Sidebar Navigation -->
    <div class="sidebar">

        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="{{ route('admin.showRegisterStudentForm') }}"><i class="fas fa-user-plus"></i> Register Student</a>
        <a href="{{ route('admin.showAddCourseForm') }}"><i class="fas fa-book"></i> Add Course</a>
        <a href="{{ route('admin.showRegisterTeacherForm') }}"><i class="fas fa-chalkboard-teacher"></i> Register Teacher</a>
        <a href="{{ route('teacher.showGrades') }}"><i class="fas fa-graduation-cap"></i> Manage Grades</a>
        <a href="{{ route('admin.users.import') }}"><i class="fas fa-file-import"></i> Import Students</a>
        <!-- New Import Students button -->

    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="top-bar">
            <h1>Admin Dashboard</h1>
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
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary" onclick="window.location='{{ route('admin.showStudents') }}'">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-user-graduate"></i> Students</h5>
                        <p class="card-text">{{ $studentCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success" onclick="window.location='{{ route('admin.showTeachers') }}'">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-chalkboard-teacher"></i> Teachers</h5>
                        <p class="card-text">{{ $teacherCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info" onclick="window.location='{{ route('admin.showCourses') }}'">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-book"></i> Courses</h5>
                        <p class="card-text">{{ $courseCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Performance Chart -->
        <div class="row mt-5">
            <div class="col-md-12">
                <canvas id="studentPerformanceChart"></canvas>
            </div>
        </div>

        <!-- Recent Activity Log -->
        <div class="row mt-5">
            <div class="col-md-12">
                <h2>Recent Activities</h2>
                <ul class="list-group">
                    @foreach($recentActivities as $activity)
                        <li class="list-group-item">{{ $activity }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Notifications -->
        <div class="row mt-5">
            <div class="col-md-12">
                <h2>Notifications</h2>
                <ul class="list-group">
                    @foreach($notifications as $notification)
                        <li class="list-group-item">{{ $notification }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="row mt-5">
            <div class="col-md-12">
                <h2>Quick Links</h2>
                <div class="list-group">
                    <a href="{{ route('admin.showRegisterStudentForm') }}" class="list-group-item list-group-item-action">Register Student</a>
                    <a href="{{ route('admin.showAddCourseForm') }}" class="list-group-item list-group-item-action">Add Course</a>
                    <a href="{{ route('admin.showRegisterTeacherForm') }}" class="list-group-item list-group-item-action">Register Teacher</a>
                    <a href="{{ route('teacher.showGrades') }}" class="list-group-item list-group-item-action">Manage Grades</a>
                </div>
            </div>
        </div>

        <!-- Performance Summary -->
        <div class="row mt-5">
            <div class="col-md-12">
                <h2>Performance Summary</h2>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card text-white bg-warning">
                            <div class="card-body">
                                <h5 class="card-title">Average Score</h5>
                                <p class="card-text">{{ $averageScore }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-danger">
                            <div class="card-body">
                                <h5 class="card-title">Pass Rate</h5>
                                <p class="card-text">{{ $passRate }}%</p>
                            </div>
                        </div>
                    </div>
                    <!-- Add more cards as needed -->
                </div>
            </div>
        </div>

        <!-- Export Data -->
        <div class="row mt-5">
            <div class="col-md-12">
                <h2>Export Data</h2>
                <a href="{{ route('admin.exportData') }}" class="btn btn-primary">Export to CSV</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('studentPerformanceChart').getContext('2d');
            var studentPerformanceChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($studentNames) !!},
                    datasets: [{
                        label: 'Scores',
                        data: {!! json_encode($studentScores) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>

</body>
</html>
