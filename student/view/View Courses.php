<?php
include 'config.php';




?>

<!DOCTYPE html>
<html>
<head>
    <title>Course Registration</title>
    <link rel="stylesheet" type="text/css" href="../css/view_courses.css">
</head>
<body>
    <h1>view course</h1>
    <div class="container">
    <form action="" method="post">
        <table>
            <th>course_name</th>
            <th>section</th>
            <th>time</th>
            <th>action</th>

            </tr>
            <?php
            $sql = "SELECT * FROM registered_courses";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['course_name'] . "</td>
                            <td>" . $row['section'] . "</td>
                            <td>" . $row['time'] . "</td>
                            
                            <td> <a href='delete_course.php?id=".$row['id']."' onclick=\"return confirm('Are you sure you want to drop this course?');\">drop</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No courses found</td></tr>";
            }

            ?>
            
        
        </table>

    </form>
    </div>
    <a href="course Registration.php">Add new course</a>
    





</body>