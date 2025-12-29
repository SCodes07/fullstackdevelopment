<?php
include 'db.php';

$id = $_GET['id'];
echo $id;

$sql = "DELETE FROM students WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header("Location: index.php");
?>
