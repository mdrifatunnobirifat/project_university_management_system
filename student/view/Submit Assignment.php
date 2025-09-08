





<?php
$success = $error = "";

// ফর্ম সাবমিট হলে
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ফর্মের ডাটা নেওয়া
    $name = trim($_POST['name']);
    $id = trim($_POST['id']);
    $course = trim($_POST['course']);
    $note = trim($_POST['note']);

    // PHP Validation
    if ($name == "" || $id == "" || $course == "" || !isset($_FILES['assignment'])) {
        $error = "All required fields must be filled.";
    } else {
        // ফাইল আপলোড ভেরিফিকেশন
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_name = basename($_FILES["assignment"]["name"]);
        $target_file = $target_dir . $file_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = array("pdf", "doc", "docx");

        if (!in_array($file_type, $allowed_types)) {
            $error = "Only PDF, DOC, DOCX files are allowed.";
        } elseif ($_FILES["assignment"]["size"] > 5 * 1024 * 1024) {
            $error = "File size must be less than 5MB.";
        } else {
            if (move_uploaded_file($_FILES["assignment"]["tmp_name"], $target_file)) {
                $success = "Assignment submitted successfully!";
            } else {
                $error = "Error uploading the file.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assignment Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
            width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }

        input, textarea, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            background: #4CAF50;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #45a049;
        }

        .success {
            color: green;
            font-weight: bold;
            text-align: center;
        }

        .error {
            color: red;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Assignment Submission</h2>

        

        <form action="" method="post" enctype="multipart/form-data">
            <label for="name">Student Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your name">

            <label for="id">Student ID</label>
            <input type="text" id="id" name="id" placeholder="Enter your student ID">

            <label for="course">Course</label>
            <select id="course" name="course">
                <option value="">-- Select Course --</option>
                <option value="cse101">CSE101</option>
                <option value="cse202">CSE202</option>
                <option value="cse303">CSE303</option>
            </select>

            <label for="assignment">Upload Assignment</label>
            <input type="file" id="assignment" name="assignment">

            <label for="note">Note (Optional)</label>
            <textarea id="note" name="note" rows="3" placeholder="Write something..."></textarea>

            <button type="submit">Submit Assignment</button>
        </form>
        <?php if ($success) { echo "<p class='success'>$success</p>"; } ?>
        <?php if ($error) { echo "<p class='error'>$error</p>"; } ?>
    </div>
    
</body>
</html>
