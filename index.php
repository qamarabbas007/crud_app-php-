<?php
include 'db.php'; // make sure your DB connection is here
?>
<h2>Student Record</h2>
<a href="add.php">➕ Add New Record</a>
<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Course</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
<?php
$result = mysqli_query($con, "SELECT * FROM students");
while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['email']}</td>
        <td>{$row['course']}</td>
        <td><img src='{$row['image']}' width='50' height='50'></td>
        <td>
            <a href='edit.php?id={$row['id']}'>Update</a> |
            <a href='delete.php?id={$row['id']}' onclick=\"return confirm('Are you sure?')\">🗑️ Delete</a>
        </td>
    </tr>";
}
?>
</table>
