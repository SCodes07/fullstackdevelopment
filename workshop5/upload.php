<?php include 'includes/header.php'; ?>

<style>
    .upload-container {
        width: 420px;
        margin: 60px auto;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        text-align: center;
    }

    .upload-container h2 {
        margin-bottom: 20px;
        color: #523b23;
    }

    input[type="file"] {
        width: 100%;
        margin-bottom: 20px;
        font-size: 14px;
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
        color: green;
        font-weight: bold;
    }

    .error {
        margin-top: 15px;
        color: red;
        font-weight: bold;
    }
</style>

<main>
    <div class="upload-container">
        <h2>Upload Profile File</h2>

        <form method="post" enctype="multipart/form-data">
            <input type="file" name="upload" required>
            <input type="submit" name="submit" value="Upload File">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (!is_dir("uploads")) {
                mkdir("uploads");
            }

            $upload_destination = "uploads/";
            $fileName = basename($_FILES['upload']['name']);
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $targetFile = $upload_destination . $fileName;
            $tempFile = $_FILES["upload"]["tmp_name"];

            $allowed_types = ["pdf", "jpg", "png"];

            if (!in_array($fileExt, $allowed_types)) {
                echo "<div class='error'>Unsupported file type. Upload PDF, JPG, or PNG.</div>";
            } else {
                if (move_uploaded_file($tempFile, $targetFile)) {
                    echo "<div class='success'>File uploaded successfully!</div>";
                } else {
                    echo "<div class='error'>File upload failed.</div>";
                }
            }
        }
        ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
