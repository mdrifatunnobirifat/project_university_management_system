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
        $username=test_input($_POST["username"]);
    }

    if(empty($course))
    {
        $courseerr="please enter the course";
    }
    else
    {
        $course=test_input($_POST["course"]);
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
        $sql="INSERT INTO course(fullname,username,course,department) VALUES('$fullname','$username','$course','$department')";
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

if(isset($_POST['submit']))
{
    $sql="INSERT INTO tcourse(fulllname,username,department,course) VALUES('$fullname','$username','$department','$course')";
}


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
             <label  style="color: rgb(13, 101, 202); font-family:Arial, Helvetica, sans-serif;  font-size: 25px;">Assign course</label><br>
             <label  style="color: rgb(22, 22, 22); ">************************************************</label>
        </h2>
        <br>
<form method="post">

        <table  class="table" style="width:1200px;font-size:18px;align:left;">
                
                <tr class="tablerow">
                    <td class="tableheading">username</td>
                    <td class="tableheading">fullname</td>
                    <td class="tableheading">department</td>
                    <td class="tableheading">assinged course</td>
               </tr>

                <?php
                if($tresult->num_rows>0)
                {
                    while($row=$tresult->fetch_assoc())
                    {
                        echo "<tr class='tablerow'>";
                        echo "<td class='tableheading'>".$row['username']."</td>";
                        echo "<td class='tableheading'>".$row['fullname']."</td>";
                        echo "<td class='tableheading'>".$row['department']."</td>";
                        echo "<td class='tableheading'><select>
                        <option value='SELECT course FROM addcourse'></option></select></td>";/////make adropdown of course name from the addcourse DB
                        echo "<td class='tableheading'><button type='submit'name='add'style='width:20px;height:20px;padding:0;border:none'><img src='../image/course_add_icon.png' alt='add'style='width:25px;height:25px;display:block;margin:auto;'></button></td>";
                        echo "</tr>";
                        
                    }

                }
                ?>

              </table>

            </form>
      </center>
        <!--<button  onclick="document.location.href='Aiub .html'" id="back">Back</button>  -->
    </body>
</html>