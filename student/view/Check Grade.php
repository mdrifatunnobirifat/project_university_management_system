<?php

include '../../main/DB/DB.php';
session_start();

if(!isset($_SESSION['username'])){
    die("Please login first.");
}

$username = $_SESSION['username'];


if(isset($_POST['action'])){
    $course = $_POST['course'] ?? '';
    if($course != ''){
        $grade_sql = "SELECT grade FROM grade WHERE username='$username' AND course_name='$course'";
        $grade_result = $conn->query($grade_sql);
        if($grade_result && $grade_result->num_rows > 0){
            $row = $grade_result->fetch_assoc();
            echo $row['grade'];
        } else {
            echo "N/A";
        }
    }
    exit; 
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Check Grade</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f8;
            padding: 20px;
        }
        .container {
            max-width: 700px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #28a745;
            color: #fff;
        }
        button {
            padding: 5px 10px;
            background-color: #007bff;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .grade {
            color: #ff0000;
            font-weight: bold;
        }
    </style>
    <script>
        function fetchGrade(course) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "", true); 
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if(xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("grade_" + course).innerText = xhr.responseText;
                }
            };
            xhr.send("action=fetch_grade&course=" + encodeURIComponent(course));
        }
    </script>
</head>
<body>
<div class="container">
    <h1>Your Courses & Grades</h1>
    <table>
        <tr>
            <th>Course Name</th>
            <th>Grade</th>
            <th>Action</th>
        </tr>
        <?php
        $course_sql = "SELECT course_name FROM user_courses WHERE username='$username'";
        $course_result = $conn->query($course_sql);

        if(!$course_result){
            echo "<tr><td colspan='3'>Query failed: " . $conn->error . "</td></tr>";
        } elseif($course_result->num_rows > 0){
            while($row = $course_result->fetch_assoc()){
                $course_name = $row['course_name'];
                echo "<tr>";
                echo "<td>$course_name</td>";
                echo "<td id='grade_$course_name' class='grade'>-</td>";
                echo "<td><button onclick=\"fetchGrade('$course_name')\">Check Grade</button></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No courses registered.</td></tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
