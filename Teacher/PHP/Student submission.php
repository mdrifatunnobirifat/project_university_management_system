<!DOCTYPE html>
<html>
<head>
    <title>AIUB Clone - Student Submissions</title>
    <link rel="stylesheet" href="../CSS/teacher.css">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f4f4;
        }
        h2 label {
            display: block;
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: rgb(44, 200, 205);
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        button {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        #id1 {
            margin: 20px auto;
            width: 95%;
        }
    </style>
</head>
<body>
    <center>
        <h2>
             <label style="color: rgb(13, 101, 202); font-size: 25px;">STUDENT SUBMISSIONS</label>
             <label style="color: rgb(22, 22, 22);">************************************************</label>
        </h2>

        <div id="id1">
            <table>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Task</th>
                    <th>Submission Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td>20-12345-1</td>
                    <td>Alice Johnson</td>
                    <td>Assignment 1</td>
                    <td>2024-08-25</td>
                    <td>Submitted</td>
                    <td><button>Grade</button></td>
                </tr>
                <tr>
                    <td>20-12346-1</td>
                    <td>Bob Wilson</td>
                    <td>Assignment 1</td>
                    <td>2024-08-26</td>
                    <td>Submitted</td>
                    <td><button>Grade</button></td>
                </tr>
            </table>
        </div>
    </center>
</body>
</html>
