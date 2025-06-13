<?php
include('db.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM students WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $id = $_GET['id'];

    // File handling
    $filename = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $location = "upload/";

    if (!empty($filename)) {
        $filepath = $location . $filename;
        move_uploaded_file($tmp_name, $filepath);

        // Update with new image
        $sql = "UPDATE students SET name='$name', email='$email', course='$course', image='$filepath' WHERE id='$id'";
    } else {
        // Keep old image
        $sql = "UPDATE students SET name='$name', email='$email', course='$course' WHERE id='$id'";
    }

    if (mysqli_query($con, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

?>

<h2>Edit Student</h2>
<form method="post" enctype="multipart/form-data">
    Name: <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br><br>
    Email: <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>
    Course: <input type="text" name="course" value="<?php echo $row['course']; ?>" required><br><br>
    Image: <input type="file" name="image"> (Current: <?php echo $row['image']; ?>)<br><br>
    <input type="submit" value="Update Student">
</form>

<br>
<a href="index.php">⬅️ Back</a>
