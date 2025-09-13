<?php
include '../../main/DB/DB.php';

// Search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM tcourse";
if ($search) {
    $sql = "SELECT * FROM tcourse WHERE id LIKE ? OR username LIKE ? OR fullname LIKE ? OR department LIKE ? OR assigncourse LIKE ? OR section LIKE ?";
    $stmt = $conn->prepare($sql);
    $search_param = "%$search%";
    $stmt->bind_param("ssssss", $search_param, $search_param, $search_param, $search_param, $search_param, $search_param);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
} else {
    $result = $conn->query($sql);
    if (!$result) {
        die("Query failed: " . $conn->error);
    }
}
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
        .form-group input {
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
    </style>
</head>
<body>
    <center>
        <h2>
            <label style="color: rgb(13, 101, 202); font-family:Arial, Helvetica, sans-serif; font-size: 25px;">Course Management</label><br>
            <label style="color: rgb(22, 22, 22);">************************************************</label>
        </h2>

        <!-- Search Form -->
        <div class="form-container">
            <h3>Search Courses</h3>
            <form method="GET">
                <div class="form-group">
                    <label>Search:</label>
                    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Enter ID, username, fullname, department, assigncourse, or section">
                    <button type="submit" class="btn">Search</button>
                    <a href="Course.php" class="btn">Clear</a>
                </div>
            </form>
        </div>

        <!-- Courses Table -->
        <div>
            <h3>All Courses</h3>
            <table class="table">
                <thead>
                    <tr>
                      
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Department</th>
                        <th>Assign Course</th>
                        <th>Section</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                
                                <td><?php echo htmlspecialchars($row['username']); ?></td>
                                <td><?php echo htmlspecialchars($row['fullname']); ?></td>
                                <td><?php echo htmlspecialchars($row['department']); ?></td>
                                <td><?php echo htmlspecialchars($row['assigncourse']); ?></td>
                                <td><?php echo htmlspecialchars($row['section']); ?></td>
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
    </center>
</body>
</html>