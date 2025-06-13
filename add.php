<?php
include('db.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    $filename = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $location = "upload/";

    if (move_uploaded_file($tmp_name, $location . $filename)) {
        echo "File uploaded in folder<br>";

        $imagePath = $location . $filename;
        $sql = "INSERT INTO students(name, email, course, image) 
                VALUES('$name', '$email', '$course', '$imagePath')";

        if (mysqli_query($con, $sql)) {
            echo "Value inserted in database<br>";
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "File upload failed<br>";
    }
}
?>

<h2>Add Student</h2>
<form method="post" enctype="multipart/form-data">
    Name: <input type="text" name="name" required> <br><br>
    Email: <input type="email" name="email" required> <br><br>
    Course: <input type="text" name="course" required> <br><br>
    Image: <input type="file" name="file" required> <br><br>
    <input type="submit" value="Add Student">
</form>
<br>
<a href="index.php">⬅️ Back</a>
