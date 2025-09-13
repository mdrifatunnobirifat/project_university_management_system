<?php
session_start();
include '../../main/DB/DB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['drop_course'])) {
    $course_id = $_POST['course_id'];
    $username = $_SESSION['username'];

    $delete_sql = "DELETE FROM course_registration WHERE username='$username'";
    if ($conn->query($delete_sql) === TRUE) {
        $success = "Course dropped successfully.";
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Drop Course</title>
    <link rel="stylesheet" type="text/css" href="../css/Drop.css">
</head>
<body>
    <div class="container">
        <h1>Drop Course</h1>
        
        <form action="Drop.php" method="post">
            <label for="course_id">Select Course to Drop:</label>
            <select name="course_id" id="course_id">
                <?php
                $username = $_SESSION['username'];
                $sql = "SELECT * FROM course_registration WHERE username='$username'";
                $result = $conn->query($sql);
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['course_name'] . "</option>";
                    }
                }
                ?>
            </select>
            <button type="submit" name="drop_course">Drop Course</button>
        </form>
        <?php
        if (isset($success)) {
            echo "<p class='success'>$success</p>";
        }
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>
        <a href="View Courses.php">Back to My Courses</a>
    </div>
</body>
</html>
