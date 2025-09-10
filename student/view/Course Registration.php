<?php

include 'config.php';

$web_sql="SELECT section,subject,time FROM web_tech";
$data_sql="SELECT section,subject,time FROM data_science";
$network_sql="SELECT section,subject,time FROM  computer_network";







?>

<!DOCTYPE html>
<html>
    <head>
        <title>Course Registration</title>
        <link rel="stylesheet" type="text/css" href="../css/Course Registration.css">
    </head>
<body>
    <div class="container">
    <form action="Course Registration.php" method="post">
    <table>
        <h1>📝 Course Registration</h1>
        <tr>
            <th>[Select]</th>
            <th>[Section]</th>
            <th>[Subject]</th>
            <th>[Time]</th>
        </tr>

        <tr>
            <th colspan="4" style="background-color:#f0f0f0;">Web Technology</th>
        </tr>
        <?php

            $result1 = $conn->query($web_sql);
            if ($result1->num_rows > 0) {
                while ($row = $result1->fetch_assoc()) {
                    echo "<tr>
                            <td><input type='checkbox' name='course[]' value='Web Technology - " . $row['section'] . "'></td>
                            <td>" . $row['section'] . "</td>
                            <td>" . $row['subject'] . "</td>
                            <td>" . $row['time'] . "</td>
                          </tr>";
                }
            }

        ?>
        <tr>
            <th colspan="4" style="background-color:#f0f0f0;">Data Science</th>
        </tr>
        <?php

            $result2 = $conn->query($data_sql);
            if ($result2->num_rows > 0) {
                while ($row = $result2->fetch_assoc()) {
                    echo "<tr>
                            <td><input type='checkbox' name='course[]' value='Data Science - " . $row['section'] . "'></td>
                            <td>" . $row['section'] . "</td>
                            <td>" . $row['subject'] . "</td>
                            <td>" . $row['time'] . "</td>
                          </tr>";
                }
            }
            ?>
        <tr>
            <th colspan="4" style="background-color:#f0f0f0;">Computer Network</th>
        </tr>
        <?php

            $result3 = $conn->query($network_sql);
            if ($result3->num_rows > 0) {
                while ($row = $result3->fetch_assoc()) {
                    echo "<tr>
                            <td><input type='checkbox' name='course[]' value='Computer Network - " . $row['section'] . "'></td>
                            <td>" . $row['section'] . "</td>
                            <td>" . $row['subject'] . "</td>
                            <td>" . $row['time'] . "</td>
                          </tr>";
                }
            }

            $conn->close();
        ?>

    </table>
        <button type="submit" name="register_course">Register</button>



        </form>
        <a href ="View Course.php">view register course</a>
        

        <?php
        
 if (isset($success)) {
            echo "<p class='success'>$success</p>";
        }
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>



    </div>
    
</html>
