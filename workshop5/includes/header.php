<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Portfolio Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background-color: #f4f6f9;
        }

        header {
            background-color: #523b23;
            color: #ffffff;
            padding: 15px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        nav {
            display: flex;
            gap: 20px;
        }

        nav a {
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            padding: 6px 10px;
            border-radius: 4px;
            transition: background 0.3s;
        }

        nav a:hover {
            background-color: #334155;
        }

        main {
            padding: 25px 40px;
        }
    </style>
</head>
<body>

<header>
    <div class="logo">Student Portfolio Management</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="add_students.php">Add Student</a>
        <a href="upload.php">Upload Profile</a>
        <a href="view_student.php">View Students</a>
    </nav>
</header>

<main>
