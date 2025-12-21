<?php include 'includes/header.php'; ?>

<style>
    .addstudentform {
        width: 420px;
        margin: 60px auto;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .addstudentform h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #523b23;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: bold;
        color: #333;
    }

    input[type="text"],
    input[type="email"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 18px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 14px;
    }

    input[type="text"]:focus,
    input[type="email"]:focus {
        outline: none;
        border-color: #1e3a8a;
    }

    input[type="submit"] {
        width: 100%;
        padding: 12px;
        background-color: #523b23;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #523b23;
    }

    .success {
        margin-top: 15px;
        text-align: center;
        color: green;
        font-weight: bold;
    }

    .error {
        margin-top: 15px;
        text-align: center;
        color: red;
        font-weight: bold;
    }
</style>

<main>
    <div class="addstudentform">
        <h2>Add Student</h2>

        <form method="post" action="">
            <label>Name</label>
            <input type="text" name="username" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Skills (space separated)</label>
            <input type="text" name="skill" placeholder="HTML CSS PHP" required>

            <input type="submit" value="Add Student">
        </form>

        <?php
        function save_in_txt($user, $email, $skillsArr) {
            try {
                if (!is_dir("data")) {
                    mkdir("data");
                }

                $skills = json_encode($skillsArr);
                $file = fopen("data/students.txt", "a");
                $content = "\n$user | $email | $skills";
                fwrite($file, $content);
                fclose($file);

                echo "<div class='success'>Student added successfully!</div>";
            } catch (Exception $e) {
                echo "<div class='error'>Failed to save data.</div>";
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $skill = trim($_POST['skill']);

            $skillsArray = explode(" ", $skill);
            save_in_txt($username, $email, $skillsArray);
        }
        ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
