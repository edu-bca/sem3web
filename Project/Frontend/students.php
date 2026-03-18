<?php 
include '../Backend/conn.php'; 

// Adding a student
if (isset($_POST['add_student'])) {
    $name = $_POST['name'];
    $roll = $_POST['roll_no'];
    mysqli_query($conn,"INSERT INTO students (name, roll_no) VALUES ('$name', '$roll')");
    header("Location: students.php"); 
}

// Deleting a student
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    mysqli_query($conn,"DELETE FROM students WHERE id = $id");
    header("Location: students.php"); 
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Students</title>
    <link rel="stylesheet" href="../Frontend/style.css">
</head>
<body>
    <nav>
        <div class="logo">Student Lists</div>
        <a href="index.php">Dashboard</a>
        <a href="students.php" class="active">Manage Students</a>
    </nav>

    <main>
        <h1>Add New Student</h1>
        <form method="POST" style="margin-bottom: 30px;">
            <input type="text" name="name" placeholder="Student Name" required>
            <input type="text" name="roll_no" placeholder="Roll No" required>
            <button type="submit" name="add_student">Save Student</button>
        </form>

        <h1>Student List</h1>
        <table border="1" width="100%">
            <tr>
                <th>Roll No</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
            <?php
            $res = mysqli_query($conn,"SELECT * FROM students");
            while($row = mysqli_fetch_assoc($res)) {
                echo "<tr>
                    <td>{$row['roll_no']}</td>
                    <td>{$row['name']}</td>
                    <td><a href='students.php?delete_id={$row['id']}'>Delete</a></td>
                </tr>";
            }
            ?>
        </table>
    </main>
</body>
</html>