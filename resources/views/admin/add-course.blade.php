<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
            color: #333;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            text-align: left;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Add Course</h1>
        <form action="{{ route('admin.addCourse') }}" method="POST">
            @csrf
            <label for="name">Course Name:</label>
            <input type="text" id="name" name="name" required>
            <button type="submit">Add Course</button>
        </form>
    </div>

</body>
</html>
