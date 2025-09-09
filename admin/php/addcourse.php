<?php
include  '../DB/registrationDB.php';

$course=$sdate=$edate2=$time=$seat="";
$courseerr=$timeerr=$date1err=$seaterr="";
$successful=$error="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
 $course=$_POST['course'];
 $sdate=$_POST['date1'];
 $edate=$_POST['date2'];
 $time=$_POST['time'];
 $seat=$_POST['seat'];


 if(empty($course))
 {
    $courseerr="please enter the course name";
 }
 else
 {
    if(preg_match("/^[a-zA-z' ]*$/",$course))
    {
        $course=test_input($_POST['course']);
    }
 }

 if(empty($dates))
 {
    $date1err="please enter course time";
 }
 else
    {
        $date1=test_input($_POST['date1']);
    }

    if(empty($time))
    {$timeerr="please select course time";}
    else
    {
        $time=test_input($_POST['time']);
    }

    if(empty($seat))
    {
        $seaterr="enter student limti";
    }
    else
    {
        $seat=test_input($_POST['seat']);
    }
  

    if(!empty($course) && !empty($sdate) && !empty($time) && !empty($seat))
    {
        $sql="INSERT INTO addcourse(course,date1,date2,time,seat) VALUES('$course','$sdate','$edate','$time','$seat')";
        if($conn->query($sql)===TRUE)
        {
            echo "<script>alert('course registered successfull);</script>";
            $course=$date1=$date2=$time=$seat="";
        }
        else
        {echo "<script>alert('try again, failed to register course');</script>";}
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
        <form method="post">
        <h2>
             <label  style="color: rgb(13, 101, 202); font-family:Arial, Helvetica, sans-serif;  font-size: 25px;">Add course</label><br>
             <label  style="color: rgb(22, 22, 22); ">************************************************</label>
        </h2>
        <br>
        <div>
        Course Name<input type="text" id="course" name="course" >\
        <span><?php echo $courseerr; ?></span><br><br>
        <select id="date1" name="date1">
            <option value="saturday">saturday</option>
            <option value="sunday">sunday</otpion>
            <option value="monday">monday</otpion>
            <option value="tuesday">tuesday</otpion>
            <option value="wednesday">wednesday</otpion>
            <option value="thrusday">thrusday</otpion>
            <option value="friday">friday</otpion>
        </select><br><br>
         <select id="date2" name="date2">
            <option value="saturday">saturday</option>
            <option value="sunday">sunday</otpion>
            <option value="monday">monday</otpion>
            <option value="tuesday">tuesday</otpion>
            <option value="wednesday">wednesday</otpion>
            <option value="thrusday">thrusday</otpion>
            <option value="friday">friday</otpion>
        </select><br><br>
        Time<input type="text" name="time" id="time">
         <span><?php echo $timeerr; ?></span><br><br>
        seat<input type="number" id="seat" name="seat">
         <span><?php echo $seaterr; ?></span><br><br><br>
        <button type="submit" style="color:green;width:70px;height:50px" >add</button>
        </div>
      </form>
      </center>
        <!--<button  onclick="document.location.href='Aiub .html'" id="back">Back</button>  -->
    </body>
</html>