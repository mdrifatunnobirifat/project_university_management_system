<!DOCTYPE html>
<html>
<head>
    <title>Home</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #11aade;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: left;
            padding: 30px;
        }
        h1 {
            text-align: left;
            margin-bottom: 20px;
            color: #333;
        }
        .nav-bar {
            background: #990808;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 200px;
            text-align:left;
        }
        .nav-bar a {
            display: block;
            margin: 10px 0;
        }
        a button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        a button:hover {
            background-color: #0056b3;
        }
        button {
            background-color: #dc3545;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
            align-self: flex-end;
        }
        button:hover {
            background-color: #c82333;
        }

        img {
            margin-bottom: 20px;
        }
    </style>
</head>
    <body>
        <form action="logout.html" method="post" >
            <button type="submit">Logout</button>
        </form>
        <img src="../img/project.png" alt="Home" width="200" height="200">
        <h1>Welcome student.....</h1>

    <div class="nav-bar">
        <a href="View Courses.html"><button>View Courses</button></a>
    <a href="Check Grade.html"><button>Check Grade</button></a>
    <a href="Submit Assignment.html"><button>Submit Assignment</button></a>
    <a href="Borrow_Library_Book.php"><button>Borrow Library Book</button></a>
    <a href="payment.html"><button>payment</button></a>
    <a href="Course Registration.html"><button>Course Registration</button></a>
    </div>
        

    </body>
</html>