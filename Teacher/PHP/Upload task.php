<?php
include '../../main/DB/DB.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_title = $_POST['task_title'];
    $course = $_POST['course'];
    $due_date = $_POST['due_date'];
    $task_description = $_POST['task_description'];
    $file_content = null; // Default to null if no file is uploaded

    // Handle file upload
    if (isset($_FILES['task_file']) && $_FILES['task_file']['error'] == UPLOAD_ERR_OK) {
        $file_content = file_get_contents($_FILES['task_file']['tmp_name']); // Read file content as binary
    }

    $sql = "INSERT INTO tasks (task_title, course, due_date, task_description, file_content) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssb", $task_title, $course, $due_date, $task_description, $file_content);

    // Bind the BLOB parameter separately
    $null = null;
    $stmt->send_long_data(4, $file_content); // Parameter index 4 is file_content

    if ($stmt->execute()) {
        $success_message = "Task uploaded successfully!";
    } else {
        $error_message = "Error uploading task: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>AIUB Clone - Upload Task</title>
        <link rel="stylesheet" href="../CSS/teacher.css">
    </head>
    <body>
        <center>
        <h2>
             <label style="color: rgb(13, 101, 202); font-family:Arial, Helvetica, sans-serif; font-size: 25px;">UPLOAD TASK</label><br>
             <label style="color: rgb(22, 22, 22);">************************************************</label>
        </h2>
    
        <div id="id1">
            <form method="POST" enctype="multipart/form-data" style="background-color: white; padding: 20px; border-radius: 10px;">
                <?php if (isset($success_message)): ?>
                    <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 3px; margin-bottom: 15px;"><?php echo $success_message; ?></div>
                <?php endif; ?>
                <?php if (isset($error_message)): ?>
                    <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 3px; margin-bottom: 15px;"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; color: black;">Task Title:</label>
                    <input type="text" name="task_title" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;" required>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; color: black;">Course:</label>
                    <input type="text" name="course" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;" required>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; color: black;">Due Date:</label>
                    <input type="date" name="due_date" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;" required>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; color: black;">Task Description:</label>
                    <textarea name="task_description" style="width: 100%; height: 150px; padding: 10px; border: 1px solid #ddd; border-radius: 5px;" required></textarea>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; color: black;">Upload File:</label>
                    <input type="file" name="task_file" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                <button type="submit">Upload Task</button>
            </form>
        </div>
        </center>
    </body>
</html>