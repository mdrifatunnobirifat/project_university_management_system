<?php
include '../DB/registrationDB.php';

$teacher="";
$course_id="";
$message="";

// Get teachers
$teachers = $conn->query("SELECT username, fullname FROM registration WHERE role='Teacher'");

// Get courses
$courses = $conn->query("SELECT id, course FROM addcourse");

// When form is submitted
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $teacher = $_POST['teacher'] ?? '';
    $course_id = $_POST['course_id'] ?? '';

    if(!empty($teacher) && !empty($course_id)){
        // check if already assigned
        $check = $conn->query("SELECT * FROM course_assign WHERE teacher_username='$teacher' AND course_id='$course_id'");
        if($check->num_rows > 0){
            $message="This course is already assigned to this teacher.";
        } else {
            $sql="INSERT INTO course_assign(teacher_username,course_id) VALUES('$teacher','$course_id')";
            if($conn->query($sql)===TRUE){
                $message="Course assigned successfully!";
            } else {
                $message="Error assigning course: ".$conn->error;
            }
        }
    } else {
        $message="Please select both teacher and course.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Assign Course</title>
    <link rel="stylesheet" href="../css/aiub.css">
</head>
<body>
<center>
    <h2>Assign Course to Teacher</h2>
    <form method="post">
        <label>Select Teacher:</label>
        <select name="teacher">
            <option value="">--Select--</option>
            <?php while($row=$teachers->fetch_assoc()){ ?>
                <option value="<?= $row['username'] ?>"><?= $row['fullname']." (".$row['username'].")" ?></option>
            <?php } ?>
        </select>
        <br><br>

        <label>Select Course:</label>
        <select name="course_id">
            <option value="">--Select--</option>
            <?php while($row=$courses->fetch_assoc()){ ?>
                <option value="<?= $row['id'] ?>"><?= $row['course'] ?></option>
            <?php } ?>
        </select>
        <br><br>

        <button type="submit">Assign</button>
    </form>
    <p style="color:blue;"><?= $message ?></p>

    <h3>Assigned Courses</h3>
    <table border="1" cellpadding="5">
        <tr>
            <th>Teacher</th>
            <th>Course</th>
            <th>Assigned At</th>
        </tr>
        <?php
        $result=$conn->query("SELECT ca.assigned_at, r.fullname, a.course 
                              FROM course_assign ca 
                              JOIN registration r ON ca.teacher_username=r.username 
                              JOIN addcourse a ON ca.course_id=a.id");
        if($result && $result->num_rows>0){
            while($row=$result->fetch_assoc()){
                echo "<tr>
                        <td>".$row['fullname']."</td>
                        <td>".$row['course']."</td>
                        <td>".$row['assigned_at']."</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No assignments yet</td></tr>";
        }
        ?>
    </table>
</center>
</body>
</html>
