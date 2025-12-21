<?php include 'includes/header.php'; ?>

<main>
    <h2>Student Details</h2>

    <?php
    $fileName = "data/students.txt";

    if (file_exists($fileName)) {
        $content = file_get_contents($fileName);

        if (!empty($content)) {
            echo "<pre>";
            echo $content;
            echo "</pre>";
        } else {
            echo "No student data available.";
        }
    } else {
        echo "Student file not found.";
    }
    ?>
</main>

<?php include 'includes/footer.php'; ?>
