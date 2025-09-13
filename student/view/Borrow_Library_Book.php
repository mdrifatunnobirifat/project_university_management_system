<?php
session_start();

include '../../main/DB/DB.php';

$book_sql="SELECT title,author,available_copies,price  FROM library_book";
$paper_sql="SELECT  title,author,available_copies,price FROM library_paper";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];
$success = "";
$error = "";

if (isset($_POST['Borrow'])) {
    $totalPrice = 0;
    $quantity = 0;
    $borrowedItems = [];

    
    if (!empty($_POST['book'])) {
        foreach ($_POST['book'] as $book) {
            
            list($table, $title) = explode(" - ", $book);

            // available copies check
            $sql = "SELECT available_copies, price FROM $table WHERE title='$title' LIMIT 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                if ($row['available_copies'] > 0) {
                    
                    $newQty = $row['available_copies'] - 1;
                    $update = "UPDATE $table SET available_copies='$newQty' WHERE title='$title'";
                    $conn->query($update);

                    
                    $totalPrice += $row['price'];
                    $quantity++;

                    
                    $borrowedItems[] = $title;
                } else {
                    $error .= "❌ '$title' not available.<br>";
                }
            }
        }
    }

    
    if (!empty($_POST['paper'])) {
        foreach ($_POST['paper'] as $paper) {
            list($table, $title) = explode(" - ", $paper);

            $sql = "SELECT available_copies, price FROM $table WHERE title='$title' LIMIT 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                if ($row['available_copies'] > 0) {
                    $newQty = $row['available_copies'] - 1;
                    $update = "UPDATE $table SET available_copies='$newQty' WHERE title='$title'";
                    $conn->query($update);

                    $totalPrice += $row['price'];
                    $quantity++;

                    $borrowedItems[] = $title;
                } else {
                    $error .= "❌ '$title' not available.<br>";
                }
            }
        }
    }

    if ($quantity > 0) {
        
        $items = implode(", ", $borrowedItems);
        $insert = "INSERT INTO borrowed_books (username, items, quantity, total_price) 
                   VALUES ('$username', '$items', '$quantity', '$totalPrice')";
        if ($conn->query($insert)) {
            $success = "✅ $username borrowed $quantity item(s). Total Price = $totalPrice Tk.<br>Books: $items";
        } else {
            $error .= "Database insert failed!<br>";
        }
    } else {
        $error .= "⚠️ Please select at least one book/paper.<br>";
    }

}


?>



<!DOCTYPE html>
<html>
    <head>
        <title>Borrow Library Book</title>
        <link rel="stylesheet" type="text/css" href="../css/Borrow Library Book.css">
    </head>
<body>
    <h1>Borrow Library Book</h1>
    <div class="container">
    <form action="Borrow_Library_Book.php" method="post">
    <table>
        
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
                            <td><input type='checkbox' name='book[]' value='library_book - " . $row['title'] . "'></td>
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
                            <td><input type='checkbox' name='paper[]' value='library_paper - " . $row['title'] . "'></td>
                            <td>" . $row['title'] . "</td>
                            <td>" . $row['author'] . "</td>
                            <td>" . $row['available_copies'] . "</td>
                            <td>" . $row['price'] . "</td>
                          </tr>";
                }
            }
            ?>
        
       

    </table>
        <button type="submit" name="Borrow">Borrow</button>



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
