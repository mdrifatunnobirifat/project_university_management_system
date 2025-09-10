<?php

include 'config.php';

$book_sql="SELECT title,author,available_copies,price  FROM library_book";
$paper_sql="SELECT  title,author,available_copies,price FROM library_paper";


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Borrow Library Book</title>
        <link rel="stylesheet" type="text/css" href="../css/Borrow Library Book.css">
    </head>
<body>
    <div class="container">
    <form action="Borrow_Library_Book.php" method="post">
    <table>
        <h1>Borrow Library Book</h1>
        <tr>
            <th>[select]</th>
            <th>[title]</th>
            <th>[author]</th>
            <th>[available_copies]</th>
            <th>[price]</th>
        </tr>

        <tr>
            <th colspan="4" style="background-color:#f0f0f0;">Book</th>
        </tr>
        <?php

            $result1 = $conn->query($book_sql);
            if ($result1->num_rows > 0) {
                while ($row = $result1->fetch_assoc()) {
                    echo "<tr>
                            <td><input type='checkbox' name='course[]' value='library_book - " . $row['title'] . "'></td>
                            <td>" . $row['title'] . "</td>
                            <td>" . $row['author'] . "</td>
                            <td>" . $row['available_copies'] . "</td>
                            <td>" . $row['price'] . "</td>
                            
                            
                          </tr>";
                }
            }

        ?>
        <tr>
            <th colspan="4" style="background-color:#f0f0f0;">paper</th>
        </tr>
        <?php

            $result2 = $conn->query($paper_sql);
            if ($result2->num_rows > 0) {
                while ($row = $result2->fetch_assoc()) {
                    echo "<tr>
                            <td><input type='checkbox' name='course[]' value='library_paper - " . $row['title'] . "'></td>
                            <td>" . $row['title'] . "</td>
                            <td>" . $row['author'] . "</td>
                            <td>" . $row['available_copies'] . "</td>
                            <td>" . $row['price'] . "</td>
                          </tr>";
                }
            }
            ?>
        
       

    </table>
        <button type="submit" name="register_course">Register</button>



        </form>
       
        

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
