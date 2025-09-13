<?php

include '../../main/DB/DB.php';
session_start();

$username = $_SESSION['username'];

$sql = "SELECT course_name, total_fee FROM course_registration WHERE username='$username'";
$result = $conn->query($sql);

$courses = "";
$total_fee = 0;
$success = $error = "";
if($result && $result->num_rows > 0){
    $row = $result->fetch_assoc();
    $courses = $row['course_name'];
    $total_fee = $row['total_fee'];
}

// Payment process
if($_SERVER['REQUEST_METHOD']=="POST" && $total_fee > 0){
    $bank_number = $_POST['bank_number'];
    $cvc = $_POST['cvc'];
    $amount = $_POST['amount'];

    // check if amount matches
    if($amount == $total_fee){
        // Payment Successful - DB update এবং payment save
        $update_sql = "UPDATE course_registration SET total_fee=0 WHERE username='$username'";
        $conn->query($update_sql);

        $insert_sql = "INSERT INTO payments (username, course_name, amount, bank_number, cvc, payment_status)
                       VALUES ('$username', '$courses', '$amount', '$bank_number', '$cvc', 'Completed')";
        if($conn->query($insert_sql) === TRUE){
            $success = "Payment Successful! Amount Paid: $amount Taka";
            $total_fee = 0; // form value update
        } else {
            $error = "Error saving payment: " . $conn->error;
        }
    } else {
        $error = "Payment failed! Amount does not match.";
    }
}

?>



<!DOCTYPE html>
<html>
    <head>
        <title>Payment</title>
        <link rel="stylesheet" type="text/css" href="../css/payment.css">
    </head>
    <body>
        <div class="container">
            <h1>Course Payment</h1>
            <?php
            if($courses){
                echo "<p>Courses Registered: <strong>$courses</strong></p>";
                echo "<p>Total Fee: <strong>$total_fee Taka</strong></p>";
            } else {
                echo "<p>No courses registered.</p>";
            }

            if($success){
                echo "<p class='success'>$success</p>";
            }
            if($error){
                echo "<p class='error'>$error</p>";
            }
            ?>

            <form action="payment.php" method="post">
                <label>Bank Number:</label>
                <input type="text" name="bank_number" placeholder="1234 5678 9012 3456" required pattern="\d{16}" title="Enter 16 digit bank number">

             <label>CVC:</label>
                <input type="text" name="cvc" placeholder="123" required pattern="\d{3}" title="Enter 3 digit CVC">

                <label>Amount (Taka):</label>
                <input type="number" name="amount" placeholder="Enter Amount" required min="<?php echo $total_fee; ?>" max="<?php echo $total_fee; ?>" value="<?php echo $total_fee; ?>">

                <button type="submit">Pay Now</button>
            </form>
        </div>
    </body>
</html>


