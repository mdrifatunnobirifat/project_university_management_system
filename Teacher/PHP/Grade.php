<?php
include 'config.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $student_id = $_POST['student_id'];
                $course_id = $_POST['course_id'];
                $grade = $_POST['grade'];
                $semester = $_POST['semester'];
                $year = $_POST['year'];
                
                $sql = "INSERT INTO grades (student_id, course_id, grade, semester, year) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iissi", $student_id, $course_id, $grade, $semester, $year);
                
                if ($stmt->execute()) {
                    $message = "Grade added successfully!";
                } else {
                    $error = "Error adding grade: " . $conn->error;
                }
                break;
                
            case 'update':
                $id = $_POST['id'];
                $student_id = $_POST['student_id'];
                $course_id = $_POST['course_id'];
                $grade = $_POST['grade'];
                $semester = $_POST['semester'];
                $year = $_POST['year'];
                
                $sql = "UPDATE grades SET student_id=?, course_id=?, grade=?, semester=?, year=? WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iissii", $student_id, $course_id, $grade, $semester, $year, $id);
                
                if ($stmt->execute()) {
                    $message = "Grade updated successfully!";
                } else {
                    $error = "Error updating grade: " . $conn->error;
                }
                break;
                
            case 'delete':
                $id = $_POST['id'];
                $sql = "DELETE FROM grades WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                
                if ($stmt->execute()) {
                    $message = "Grade deleted successfully!";
                } else {
                    $error = "Error deleting grade: " . $conn->error;
                }
                break;
        }
    }
}

// Search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT g.*, c.course_name, c.course_code 
        FROM grades g 
        LEFT JOIN courses c ON g.course_id = c.id";
if ($search) {
    $sql .= " WHERE g.student_id LIKE '%$search%' OR c.course_name LIKE '%$search%' OR c.course_code LIKE '%$search%'";
}
$result = $conn->query($sql);

// Get courses for dropdown
$courses_sql = "SELECT id, course_code, course_name FROM courses";
$courses_result = $conn->query($courses_sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Grade Management</title>
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
        .grade-a { background-color: #d4edda; }
        .grade-b { background-color: #d1ecf1; }
        .grade-c { background-color: #fff3cd; }
        .grade-d { background-color: #f8d7da; }
        .grade-f { background-color: #f5c6cb; }
    </style>
</head>
<body>
    <center>
        <h2>
            <label style="color: rgb(13, 101, 202); font-family:Arial, Helvetica, sans-serif; font-size: 25px;">Student Grade Management</label><br>
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
            <h3>Search Grades</h3>
            <form method="GET">
                <div class="form-group">
                    <label>Search:</label>
                    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Enter student ID or course name">
                    <button type="submit" class="btn">Search</button>
                    <a href="Grade.php" class="btn">Clear</a>
                </div>
            </form>
        </div>

        <!-- Add Grade Form -->
        <div class="form-container">
            <h3>Add New Grade</h3>
            <form method="POST">
                <input type="hidden" name="action" value="add">
                <div class="form-group">
                    <label>Student ID:</label>
                    <input type="number" name="student_id" required>
                </div>
                <div class="form-group">
                    <label>Course:</label>
                    <select name="course_id" required>
                        <option value="">Select Course</option>
                        <?php if ($courses_result && $courses_result->num_rows > 0): ?>
                            <?php while($course = $courses_result->fetch_assoc()): ?>
                                <option value="<?php echo $course['id']; ?>">
                                    <?php echo $course['course_code'] . ' - ' . $course['course_name']; ?>
                                </option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Grade:</label>
                    <select name="grade" required>
                        <option value="">Select Grade</option>
                        <option value="A+">A+</option>
                        <option value="A">A</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B">B</option>
                        <option value="B-">B-</option>
                        <option value="C+">C+</option>
                        <option value="C">C</option>
                        <option value="C-">C-</option>
                        <option value="D+">D+</option>
                        <option value="D">D</option>
                        <option value="F">F</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Semester:</label>
                    <select name="semester" required>
                        <option value="">Select Semester</option>
                        <option value="Spring">Spring</option>
                        <option value="Summer">Summer</option>
                        <option value="Fall">Fall</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Year:</label>
                    <input type="number" name="year" min="2020" max="2030" value="<?php echo date('Y'); ?>" required>
                </div>
                <button type="submit" class="btn">Add Grade</button>
            </form>
        </div>

        <!-- Grades Table -->
        <div>
            <h3>All Grades</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student ID</th>
                        <th>Course</th>
                        <th>Grade</th>
                        <th>Semester</th>
                        <th>Year</th>
                        <th>Date Added</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <?php
                            $grade_class = '';
                            switch(substr($row['grade'], 0, 1)) {
                                case 'A': $grade_class = 'grade-a'; break;
                                case 'B': $grade_class = 'grade-b'; break;
                                case 'C': $grade_class = 'grade-c'; break;
                                case 'D': $grade_class = 'grade-d'; break;
                                case 'F': $grade_class = 'grade-f'; break;
                            }
                            ?>
                            <tr class="<?php echo $grade_class; ?>">
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['student_id']; ?></td>
                                <td><?php echo htmlspecialchars($row['course_code'] . ' - ' . $row['course_name']); ?></td>
                                <td><strong><?php echo $row['grade']; ?></strong></td>
                                <td><?php echo $row['semester']; ?></td>
                                <td><?php echo $row['year']; ?></td>
                                <td><?php echo $row['created_at']; ?></td>
                                <td>
                                    <button onclick="editGrade(<?php echo $row['id']; ?>, <?php echo $row['student_id']; ?>, <?php echo $row['course_id']; ?>, '<?php echo $row['grade']; ?>', '<?php echo $row['semester']; ?>', <?php echo $row['year']; ?>)" class="btn">Edit</button>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this grade?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">No grades found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Edit Grade Modal (Hidden by default) -->
        <div id="editModal" style="display:none;" class="form-container">
            <h3>Edit Grade</h3>
            <form method="POST">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" id="edit_id">
                <div class="form-group">
                    <label>Student ID:</label>
                    <input type="number" name="student_id" id="edit_student_id" required>
                </div>
                <div class="form-group">
                    <label>Course:</label>
                    <select name="course_id" id="edit_course_id" required>
                        <option value="">Select Course</option>
                        <?php 
                        // Reset courses result for edit modal
                        $courses_result = $conn->query($courses_sql);
                        if ($courses_result && $courses_result->num_rows > 0): 
                        ?>
                            <?php while($course = $courses_result->fetch_assoc()): ?>
                                <option value="<?php echo $course['id']; ?>">
                                    <?php echo $course['course_code'] . ' - ' . $course['course_name']; ?>
                                </option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Grade:</label>
                    <select name="grade" id="edit_grade" required>
                        <option value="">Select Grade</option>
                        <option value="A+">A+</option>
                        <option value="A">A</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B">B</option>
                        <option value="B-">B-</option>
                        <option value="C+">C+</option>
                        <option value="C">C</option>
                        <option value="C-">C-</option>
                        <option value="D+">D+</option>
                        <option value="D">D</option>
                        <option value="F">F</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Semester:</label>
                    <select name="semester" id="edit_semester" required>
                        <option value="">Select Semester</option>
                        <option value="Spring">Spring</option>
                        <option value="Summer">Summer</option>
                        <option value="Fall">Fall</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Year:</label>
                    <input type="number" name="year" id="edit_year" min="2020" max="2030" required>
                </div>
                <button type="submit" class="btn">Update Grade</button>
                <button type="button" class="btn btn-danger" onclick="cancelEdit()">Cancel</button>
            </form>
        </div>
    </center>

    <script>
        function editGrade(id, student_id, course_id, grade, semester, year) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_student_id').value = student_id;
            document.getElementById('edit_course_id').value = course_id;
            document.getElementById('edit_grade').value = grade;
            document.getElementById('edit_semester').value = semester;
            document.getElementById('edit_year').value = year;
            document.getElementById('editModal').style.display = 'block';
        }

        function cancelEdit() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
</body>
</html>