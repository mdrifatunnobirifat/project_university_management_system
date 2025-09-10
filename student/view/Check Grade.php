<?php
$grade_result = "";
$error = "";

$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "university management system";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = trim($_POST['student_id']);

    if ($student_id == "") {
        $error = "Please enter your Student ID.";
    } else {
        $sql = "SELECT course, grade FROM grades WHERE student_id='$student_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $grade_result = "<table border='1' cellpadding='5' style='margin-top:10px;'>";
            $grade_result .= "<tr><th>Course</th><th>Grade</th></tr>";
            while ($row = $result->fetch_assoc()) {
                $grade_result .= "<tr><td>{$row['course']}</td><td>{$row['grade']}</td></tr>";
            }
            $grade_result .= "</table>";
        } else {
            $error = "No grades found for Student ID: $student_id";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Grade Check</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        input { padding: 5px; width: 200px; margin-right: 10px; }
        button { padding: 5px 10px; }
        .error { color: red; margin-top: 10px; }
        table { border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 8px 12px; border: 1px solid #ccc; }
    </style>
</head>
<body>

<h2>Check Your Grade</h2>

<form method="post">
    <input type="text" name="student_id" placeholder="Enter Student ID">
    <button type="submit">Check Grade</button>
</form>

<?php
if ($error) echo "<div class='error'>$error</div>";
if ($grade_result) echo $grade_result;
?>

</body>
</html>
