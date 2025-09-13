<?php
include '../../main/DB/DB.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = $_POST['subject'];
    $target_audience = $_POST['target_audience'];
    $message = $_POST['message'];

    $sql = "INSERT INTO announcements (subject, target_audience, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $subject, $target_audience, $message);

    if ($stmt->execute()) {
        $success_message = "Announcement sent successfully!";
    } else {
        $error_message = "Error sending announcement: " . $conn->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>AIUB Clone - Send Announcement</title>
        <link rel="stylesheet" href="../CSS/teacher.css">
    </head>
    <body>
        <center>
        <h2>
             <label style="color: rgb(13, 101, 202); font-family:Arial, Helvetica, sans-serif; font-size: 25px;">SEND ANNOUNCEMENT</label><br>
             <label style="color: rgb(22, 22, 22);">************************************************</label>
        </h2>
    
        <div id="id1">
            <form method="POST" style="background-color: white; padding: 20px; border-radius: 10px;">
                <?php if (isset($success_message)): ?>
                    <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 3px; margin-bottom: 15px;"><?php echo $success_message; ?></div>
                <?php endif; ?>
                <?php if (isset($error_message)): ?>
                    <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 3px; margin-bottom: 15px;"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; color: black;">Subject:</label>
                    <input type="text" name="subject" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;" required>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; color: black;">Target Audience:</label>
                    <select name="target_audience" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;" required>
                        <option value="All Students">All Students</option>
                        <option value="Specific Course">Specific Course</option>
                    </select>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; color: black;">Message:</label>
                    <textarea name="message" style="width: 100%; height: 150px; padding: 10px; border: 1px solid #ddd; border-radius: 5px;" required></textarea>
                </div>
                <button type="submit">Send Announcement</button>
            </form>
        </div>
        </center>
    </body>
</html>