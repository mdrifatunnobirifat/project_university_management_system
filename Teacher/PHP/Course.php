<?php
include 'config.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $course_code = $_POST['course_code'];
                $course_name = $_POST['course_name'];
                $teacher_id = $_POST['teacher_id'];
                $credits = $_POST['credits'];
                
                $sql = "INSERT INTO courses (course_code, course_name, teacher_id, credits) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssii", $course_code, $course_name, $teacher_id, $credits);
                
                if ($stmt->execute()) {
                    $message = "Course added successfully!";
                } else {
                    $error = "Error adding course: " . $conn->error;
                }
                break;
                
            case 'update':
                $id = $_POST['id'];
                $course_code = $_POST['course_code'];
                $course_name = $_POST['course_name'];
                $teacher_id = $_POST['teacher_id'];
                $credits = $_POST['credits'];
                
                $sql = "UPDATE courses SET course_code=?, course_name=?, teacher_id=?, credits=? WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssiii", $course_code, $course_name, $teacher_id, $credits, $id);
                
                if ($stmt->execute()) {
                    $message = "Course updated successfully!";
                } else {
                    $error = "Error updating course: " . $conn->error;
                }
                break;
                
            case 'delete':
                $id = $_POST['id'];
                $sql = "DELETE FROM courses WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                
                if ($stmt->execute()) {
                    $message = "Course deleted successfully!";
                } else {
                    $error = "Error deleting course: " . $conn->error;
                }
                break;
        }
    }
}

// Search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM courses";
if ($search) {
    $sql .= " WHERE course_code LIKE '%$search%' OR course_name LIKE '%$search%'";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Course Management</title>
    <link rel="stylesheet" href="../CSS/teacher.css">
    <style>
        .form-container {
            background: #f4f4f4;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .form-group {
            margin: 10px 0;
        }
        .form-group label {
            display: inline-block;
            width: 120px;
            font-weight: bold;
        }
        .form-group input, .form-group select {
            padding: 8px;
            width: 200px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        .btn {
            background: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin: 5px;
        }
        .btn:hover {
            background: #0056b3;
        }
        .btn-danger {
            background: #dc3545;
        }
        .btn-danger:hover {
            background: #c82333;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .table th {
            background: #f8f9fa;
        }
        .message {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 3px;
            margin: 10px 0;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 3px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <center>
        <h2>
            <label style="color: rgb(13, 101, 202); font-family:Arial, Helvetica, sans-serif; font-size: 25px;">Course Management</label><br>
            <label style="color: rgb(22, 22, 22);">************************************************</label>
        </h2>

        <?php if (isset($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Search Form -->
        <div class="form-container">
            <h3>Search Courses</h3>
            <form method="GET">
                <div class="form-group">
                    <label>Search:</label>
                    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Enter course code or name">
                    <button type="submit" class="btn">Search</button>
                    <a href="Course.php" class="btn">Clear</a>
                </div>
            </form>
        </div>

        <!-- Add Course Form -->
        <div class="form-container">
            <h3>Add New Course</h3>
            <form method="POST">
                <input type="hidden" name="action" value="add">
                <div class="form-group">
                    <label>Course Code:</label>
                    <input type="text" name="course_code" required>
                </div>
                <div class="form-group">
                    <label>Course Name:</label>
                    <input type="text" name="course_name" required>
                </div>
                <div class="form-group">
                    <label>Teacher ID:</label>
                    <input type="number" name="teacher_id" required>
                </div>
                <div class="form-group">
                    <label>Credits:</label>
                    <input type="number" name="credits" min="1" max="4" required>
                </div>
                <button type="submit" class="btn">Add Course</button>
            </form>
        </div>

        <!-- Courses Table -->
        <div>
            <h3>All Courses</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Teacher ID</th>
                        <th>Credits</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['course_code']); ?></td>
                                <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                                <td><?php echo $row['teacher_id']; ?></td>
                                <td><?php echo $row['credits']; ?></td>
                                <td>
                                    <button onclick="editCourse(<?php echo $row['id']; ?>, '<?php echo $row['course_code']; ?>', '<?php echo $row['course_name']; ?>', <?php echo $row['teacher_id']; ?>, <?php echo $row['credits']; ?>)" class="btn">Edit</button>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this course?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No courses found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Edit Course Modal (Hidden by default) -->
        <div id="editModal" style="display:none;" class="form-container">
            <h3>Edit Course</h3>
            <form method="POST">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" id="edit_id">
                <div class="form-group">
                    <label>Course Code:</label>
                    <input type="text" name="course_code" id="edit_course_code" required>
                </div>
                <div class="form-group">
                    <label>Course Name:</label>
                    <input type="text" name="course_name" id="edit_course_name" required>
                </div>
                <div class="form-group">
                    <label>Teacher ID:</label>
                    <input type="number" name="teacher_id" id="edit_teacher_id" required>
                </div>
                <div class="form-group">
                    <label>Credits:</label>
                    <input type="number" name="credits" id="edit_credits" min="1" max="4" required>
                </div>
                <button type="submit" class="btn">Update Course</button>
                <button type="button" class="btn btn-danger" onclick="cancelEdit()">Cancel</button>
            </form>
        </div>
    </center>

    <script>
        function editCourse(id, course_code, course_name, teacher_id, credits) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_course_code').value = course_code;
            document.getElementById('edit_course_name').value = course_name;
            document.getElementById('edit_teacher_id').value = teacher_id;
            document.getElementById('edit_credits').value = credits;
            document.getElementById('editModal').style.display = 'block';
        }

        function cancelEdit() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
</body>
</html>