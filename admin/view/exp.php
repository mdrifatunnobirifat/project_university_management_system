<?php
include '../php/registrationDB.php';
$query = "SELECT ID, fullname, username FROM registration WHERE role='Teacher'";
$result = $conn->query($query);

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM registration WHERE ID=$id AND role='Teacher'";
    mysqli_query($conn, $sql);
    header("Location:" . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $sql = "UPDATE registration SET fullname='$fullname', username='$username' 
            WHERE id=$id AND role='Teacher'";
    mysqli_query($conn, $sql);
    header("Location:" . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['add'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $sql = "INSERT INTO registration(fullname, username, role) 
            VALUES('$fullname', '$username','Teacher')";
    mysqli_query($conn, $sql);
    header("Location:" . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Teacher</title>
</head>
<body>
<center>
    <h2>Manage Teacher</h2>

    <!-- Show teachers table -->
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Userid</th>
        </tr>
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                echo "<td>" . htmlspecialchars($row['fullname']) . "</td>";
                echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No teachers found</td></tr>";
        }
        $conn->close();
        ?>
    </table>

    <br><br>

    <!-- Form to add new teacher -->
    <h3>Add Teacher</h3>
    <form method="post">
        Full Name: <input type="text" name="fullname"><br><br>
        User Name: <input type="text" name="username"><br><br>
        <button type="submit" name="add">Add</button>
    </form>

    <br><br>

    <!-- Form to update teacher -->
    <h3>Update Teacher</h3>
    <form method="post">
        Enter Teacher ID: <input type="number" name="id"><br><br>
        New Full Name: <input type="text" name="fullname"><br><br>
        New User Name: <input type="text" name="username"><br><br>
        <button type="submit" name="update">Update</button>
    </form>

    <br><br>

    <!-- Form to delete teacher -->
    <h3>Delete Teacher</h3>
    <form method="post" onsubmit="return confirm('Are you sure to delete this teacher?');">
        Enter Teacher ID: <input type="number" name="id"><br><br>
        <button type="submit" name="delete" style="background:red;color:white;">Delete</button>
    </form>
</center>
</body>
</html>
