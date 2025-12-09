<?php

// Error messages
$errors = [
    "name" => "",
    "email" => "",
    "password" => "",
    "confirm_password" => "",
    "general" => ""
];

$success = "";

// When form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Read form values
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirmPassword = $_POST["confirm_password"] ?? "";

    // -----------------------
    // VALIDATION
    // -----------------------

    if ($name === "") {
        $errors["name"] = "Name is required.";
    }

    if ($email === "") {
        $errors["email"] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email address.";
    }

    if ($password === "") {
        $errors["password"] = "Password is required.";
    } elseif (strlen($password) < 8) {
        $errors["password"] = "Password must be at least 8 characters.";
    } elseif (!preg_match('/[^a-zA-Z0-9]/', $password)) {
        $errors["password"] = "Password must contain at least one special character.";
    }

    if ($confirmPassword === "") {
        $errors["confirm_password"] = "Please confirm your password.";
    } elseif ($password !== $confirmPassword) {
        $errors["confirm_password"] = "Passwords do not match.";
    }

    // Check for errors
    $hasError = false;
    foreach ($errors as $msg) {
        if (!empty($msg)) {
            $hasError = true;
            break;
        }
    }

    // -----------------------
    // IF NO ERRORS → SAVE USER
    // -----------------------
    if (!$hasError) {
        $file = "users.json";

        // Create empty file if missing
        if (!file_exists($file)) {
            file_put_contents($file, "[]");
        }

        // Read file
        $jsonData = file_get_contents($file);
        if ($jsonData === false) {
            $errors["general"] = "Error reading user file.";
        } else {
            $users = json_decode($jsonData, true);
            if (!is_array($users)) {
                $users = [];
            }

            // Check duplicate email
            foreach ($users as $u) {
                if ($u["email"] === $email) {
                    $errors["email"] = "Email already registered.";
                    $hasError = true;
                    break;
                }
            }

            // Save new user
            if (!$hasError) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $newUser = [
                    "name" => $name,
                    "email" => $email,
                    "password" => $hashedPassword,
                    "created_at" => date("Y-m-d H:i:s")
                ];

                $users[] = $newUser;

                if (file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT)) === false) {
                    $errors["general"] = "Error writing to users.json.";
                } else {
                    $success = "Registration successful!";
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="form-box">
    <h2>Register</h2>

    <?php if (!empty($success)): ?>
        <p class="success"><?= $success ?></p>
    <?php endif; ?>

    <?php if (!empty($errors["general"])): ?>
        <p class="error"><?= $errors["general"] ?></p>
    <?php endif; ?>

    <form method="POST">

        <label>Name</label>
        <input type="text" name="name">
        <div class="error"><?= $errors["name"] ?></div>

        <label>Email</label>
        <input type="text" name="email">
        <div class="error"><?= $errors["email"] ?></div>

        <label>Password</label>
        <input type="password" name="password">
        <div class="error"><?= $errors["password"] ?></div>

        <label>Confirm Password</label>
        <input type="password" name="confirm_password">
        <div class="error"><?= $errors["confirm_password"] ?></div>

        <button type="submit">Register</button>

    </form>
</div>

</body>
</html>
