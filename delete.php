<?php
include 'db.php';

if (!isset($_GET['id'])) {
    echo "Invalid request";
    exit();
}

$id = intval($_GET['id']); // prevent SQL injection

$sql = "DELETE FROM students WHERE id = $id";
if (mysqli_query($con, $sql)) {
    header("Location: index.php");
    exit();
} else {
    echo "Error deleting record: " . mysqli_error($con);
}
?>
