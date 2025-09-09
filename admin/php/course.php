<?php
include  '../DB/registrationDB.php';
$tsql="SELECT username,fullname FROM teacher ";
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


   if(emtpy($fullname))
   {
    $fullnameerr="enter the fullname";
   }
   else
{
     $fullname=test_input($_POST['fullname']);
   }

    if(emtpy($username))
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

        

       
      </center>
        <!--<button  onclick="document.location.href='Aiub .html'" id="back">Back</button>  -->
    </body>
</html>