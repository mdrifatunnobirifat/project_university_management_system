<?php
include  '../DB/registrationDB.php';

$tsql="SELECT username,fullname,department FROM registration WHERE role='Teacher' ";
$tresult=$conn->query($tsql);

$csql="SELECT course,date1,date2,time  FROM addcourse";
$cresult=$conn->query($csql);


$fullname=$usename=$course=$department="";
$fullname=$usenameerr=$courseerr=$departmenterr="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{   
    $fullname=$_POST['fullname'];
    $username=$_POST['username'];
    $course=$_POST['course'];
    $section=$_POST['section'];
    $department=$_POST['department'];


   if(empty($fullname))
   {
    $fullnameerr="enter the fullname";
   }
   else
{
     $fullname=test_input($_POST['fullname']);
   }

    if(empty($username))
    {
     $usenameerr="plaese select usr name";
    }

    else
    {
        $username=test_input($_POST['username']);
    }

    if(empty($course))
    {
        $courseerr="please enter the course";
    }
    else
    {
        $course=test_input($_POST['course']);
    }

    if(empty($department))
    {
        $departmenterr="plase select department";
    }
    else
    {
        $department=test_input($_POST['department']);
    }
    if(!empty($username) && ! empty($course) && !empty($department))
    {
        $sql="INSERT INTO tcourse(fullname,username,assigncourse,department,section) VALUES('$fullname','$username','$course','$department','$section')";
        if($conn->query($sql)===TRUE)
        {
            echo "<script>alert('successfully assign');</script>";
        }

        else{
            echo "<script>alert('failde');</script>";
        }
    }

}


function test_input($data)
{
    $data=trim($data);
    $data=htmlspecialchars($data);
    return $data;

}

if(isset($_POST['add']))
{
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $department = $_POST['department'];
    $course = $_POST['course'];

    $sql="INSERT INTO tcourse(username,fullname,department,assigncourse,section) 
          VALUES('$username''$fullname','$department','$course','$section')";

    if($conn->query($sql)===TRUE){
        echo "<script>alert('Successfully assigned!');</script>";
    } else {
        echo "<script>alert('Failed: ".$conn->error."');</script>";
    }
}


?>
<?php
include  '../DB/registrationDB.php';

// Teachers
$tsql="SELECT username, fullname, department FROM registration WHERE role='Teacher'";
$tresult=$conn->query($tsql);

// Courses (we will reuse this later)
$csql="SELECT course FROM addcourse";
$courses = $conn->query($csql)->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>aiub clone</title>
    <link rel="stylesheet"  href="../css/aiub.css">
</head>
<body>
<center>
    <h2>
        <label style="color: rgb(13, 101, 202); font-family:Arial, Helvetica, sans-serif; font-size: 25px;">
            Assign course
        </label><br>
        <label style="color: rgb(22, 22, 22);">************************************************</label>
    </h2>
    <br>

    <form method="post">
        <table class="table" style="width:1200px;font-size:18px;align:left;">
            <tr class="tablerow">
                <td class="tableheading">username</td>
                <td class="tableheading">fullname</td>
                <td class="tableheading">department</td>
                <td class="tableheading">assigned course</td>
                <td class="tableheading">Action</td>
            </tr>

            <?php
            if($tresult->num_rows > 0) {
                while($trow = $tresult->fetch_assoc()) {          /////crow is course row and trow is teacher row
                    echo "<tr class='tablerow'>";
                    echo "<td class='tableheading'>".$trow['username']."</td>";
                    echo "<td class='tableheading'>".$trow['fullname']."</td>";
                    echo "<td class='tableheading'>".$trow['department']."</td>";

                    // Dropdown for courses
                    echo "<td class='tableheading'><select name='course'>";
                    echo "<option value=''>-- Select Course --</option>";
                    foreach($courses as $crow) {
                        echo "<option value='".$crow['course']."-".$crow['section']."'>".$crow['course']."".$crow['section']."</option>";
                       
                    }
                    echo "</select></td>";


                    // Add button
                    echo "<td class='tableheading'>
                            <button type='submit' name='add' 
                                style='width:30px;height:30px;padding:0;border:none'>
                                <img src='../image/course_add_icon.png' 
                                    alt='add' style='width:25px;height:25px;display:block;margin:auto;'>
                            </button>
                          </td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
    </form>
</center>
</body>
</html>
