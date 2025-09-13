<!DOCTYPE html>
<html>
<head>
    <title>AIUB Clone - Study Materials</title>
    <link rel="stylesheet" href="../CSS/teacher.css">
</head>
<body>
<center>
    <h2>
        <label style="color: rgb(13, 101, 202); font-family:Arial, Helvetica, sans-serif; font-size: 25px;">STUDY MATERIALS</label><br>
        <label style="color: rgb(22, 22, 22);">************************************************</label>
    </h2>

    <div id="id1">
        <div style="background-color: white; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
            <h3 style="color: black;">Upload New Material</h3>

            <!-- Upload Form -->
            <form method="POST" enctype="multipart/form-data">
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; color: black;">Material Title:</label>
                    <input type="text" name="title" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; color: black;">Course:</label>
                    <select name="course" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                        <option value="CSE 101">CSE 101 - Programming Fundamentals</option>
                        <option value="MAT 201">MAT 201 - Calculus I</option>
                        <option value="ENG 101">ENG 101 - English Composition</option>
                    </select>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; color: black;">Upload File:</label>
                    <input type="file" name="fileUpload" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                <button type="submit" name="upload">Upload Material</button>
            </form>
        </div>

        <!-- Table for Materials -->
        <table style="width: 100%; background-color: white; border-collapse: collapse;">
            <tr style="background-color: rgb(44, 200, 205);">
                <th style="padding: 10px; border: 1px solid #ddd;">Material ID</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Title</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Course</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Upload Date</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Action</th>
            </tr>

            <?php
            // Database connection
           include '../../main/DB/DB.php';

            // Handle upload
            if (isset($_POST['upload'])) {
                $title = $_POST['title'];
                $course = $_POST['course'];
                $date = date("Y-m-d");

                // Read file as binary
                $fileData = addslashes(file_get_contents($_FILES['fileUpload']['tmp_name']));

                $sql = "INSERT INTO Material (Title, Course, Upload_Date, Upload_File) 
                        VALUES ('$title', '$course', '$date', '$fileData')";
                if ($conn->query($sql)) {
                    echo "<p style='color:green;'>Material uploaded successfully!</p>";
                } else {
                    echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
                }
            }

            // Fetch and display materials
            $result = $conn->query("SELECT Material_ID, Title, Course, Upload_Date FROM Material");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td style='padding: 10px; border: 1px solid #ddd;'>{$row['Material_ID']}</td>
                        <td style='padding: 10px; border: 1px solid #ddd;'>{$row['Title']}</td>
                        <td style='padding: 10px; border: 1px solid #ddd;'>{$row['Course']}</td>
                        <td style='padding: 10px; border: 1px solid #ddd;'>{$row['Upload_Date']}</td>
                        <td style='padding: 10px; border: 1px solid #ddd;'>
                            <a href='download.php?id={$row['Material_ID']}'><button>Download</button></a>
                        </td>
                      </tr>";
            }
            ?>
        </table>
    </div>
</center>
</body>
</html>
