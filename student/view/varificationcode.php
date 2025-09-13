<?php
include '../../main/DB/DB.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];  // hidden field or session
    $code = $_POST['code'];

    $sql = "SELECT * FROM reset_codes 
            WHERE email='$email' 
            AND code='$code' 
            AND expires_at > NOW() 
            LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['verified_email'] = $email; // password reset page-এ ব্যবহার হবে
        header("Location: reset_password.php"); // redirect to reset password page
        exit;
    } else {
        echo "<p style='color:red;'>Invalid or expired code.</p>";
    }
}
?>






<!DOCTYPE html>
<html>
    <head>
        <title>Verification Code</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #11aade;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 30px;
            }
            h2 {
                text-align: center;
                margin-bottom: 20px;
                color: #333;
            }
            form {
                background: #fff;
                padding: 30px 40px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                width: 400px;
            }
            label {
                font-weight: bold;
                display: block;
                margin: 12px 0 6px;
            }
            input[type="text"] {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 6px;
                background-color: #fff8f3;
                font-size: 14px;
            }
            button {
                background-color: #007bff;
                color: white;
                padding: 10px 15px;
                border: none;
                border-radius: 6px;
                cursor: pointer;
                font-size: 16px;
            }
            button:hover {
                background-color: #0056b3;
            }
            img {
                margin-bottom: 20px;
            }
        </style>

    </head>
    <body>
        <img src="../../main/image/project.png" alt="Forget Password" width="200" height="200"><br><br>

        <h2>Enter your verification code</h2>
        <form action="/verify_code" method="post">
            <label for="code">Verification Code:</label>
            <input type="text" id="code" name="code" required><br><br>
            <button type="submit">Verify</button>
        </form>
    </body>