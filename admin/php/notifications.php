<?php
include '../../main/DB/DB.php';

$sql="SELECT username FROM registration WHERE  role='Student' OR role='Teacher'";
$result=$conn->query($sql);


if($_SERVER['REQUEST_METHOD']==="POST")
{
   $send=$_POST['comment'];
   if(isset($_POST['send']))
   {
    $sql="UPDATE  registration SET notification='$send' WHERE role='Student' OR role='Teacher'";
    $result=$conn->query($sql);
    if($result)
     {
    echo "<script>alert('sended to all user');</script>";
     }
     else
     {
             echo "<script>alert('try again');</script>";
     }
   }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>AIUB clone</title>
        <link rel="stylesheet"  href="../css/aiub.css">
        <style>
            body
            {
                background-image:url("../../main/image/notification background.jpg");
                background-size:cover;
                background-repeat:no-repeat;
                background-position:center;

            }
        </style>
    </head>
    <body>
        
       <center>
        <h2>
             <label  style="color: rgb(13, 101, 202); font-family:Arial, Helvetica, sans-serif;  font-size: 25px;">Notifications</label><br>
             <label  style="color: rgb(22, 22, 22); ">************************************************</label>
        </h2>
        <form method="post">
        <div style="width:330px; height:500px; border:5px solid black;background-color:rgba(23, 106, 148, 1);">
            <br><br><br>
            <textarea name="comment" placeholder="enter your notifications" style="width:300px;height:200px;border-radius:3px;"></textarea><br><br>
            <button  type="submit" name="send" style="width:60px;height:60px;border:none;padding:1px;"><img src="../../main/image/admin notifications.png" alt="send" style="width:58px;height:58px;object-fit:cover;"></button>
       </div>
</form>
        </center>
    
        <!--<button  onclick="document.location.href='Aiub .html'" id="back">Back</button> -->
    </body>
</html>