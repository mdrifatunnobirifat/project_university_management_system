








<!DOCTYPE html>
<html>
    <head>
        <title>Forget Password</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #11aade;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 30px;
            }
            .form-container {
                background: #fff;
                padding: 30px 40px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                width: 400px;
                text-align: center;
            }
            form {
                margin-top: 20px;
            }
            h2 {
                text-align: center;
                margin-bottom: 20px;
                color: #333;
            }
            label {
                font-weight: bold;
                display: block;
                margin: 12px 0 6px;
            }
            input[type="email"] {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 6px;
                background-color: #fff8f3;
                font-size: 14px;
            }
            input[type="submit"] {
                background-color: #28a745;
                color: white;
                padding: 10px 15px;
                border: none;
                border-radius: 6px;
                cursor: pointer;
                font-size: 16px;
            }
            input[type="submit"]:hover {
                background-color: #218838;
            }
            p {
                margin-top: 15px;
            }
            a {
                color: #007bff;
                text-decoration: none;
            }
            a:hover {
                text-decoration: underline;
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

        </style>

    </head>
    <body>
        <div class="form-container">
        <img src="../img/project.png" alt="Forget Password" width="200" height="200"><br><br>
        <h2>Forget Password Page</h2>
        <form>
            <label>Enter your registered email:</label><br>
            <input type="email" id="email"><br><br>
            <button type="submit">Submit</button>
            <p>Remembered your password? <a href="login.html">Login here</a></p>
            <p>New user? <a href="registration.html">Register here</a></p>

        </form>
        </div>
    </body>
</html>