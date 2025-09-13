<?php
session_start();


if(!isset($_SESSION['username']))
{
    header('Location:/project_university_management_system/main/login.php');
    exit();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>aiub clone</title>
        <link rel="stylesheet"  href="../CSS/teacher.css">
    </head>
    <body>
        <header>
            <img src="../../main/image/IMG-20250823-WA0011.jpg" alt="AIUB" style="float: inline-start; width:95px; height: 95px; margin-top: -30px;">
            <label  style="color: rgb(22, 22, 22); font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-size: 30px;">UNIVERSITY MANAGEMENT Teacher PAGE</label>
        </header>
        <br>
        <br> 
        <center> 
        <div class="dropdown" style="float:left;">  
         <img src="../../main/image/menu icon.jpg " alt = "menu" style ="width:50px; height:50px;" class="dropbtn">
        
         <div  class="dropdown-content" style="left:0;">
           
           <a href="#" onclick="loadpage('../php/Course.php')"><button >Assign Course</button></a>
           <a href="#" onclick="loadpage('../php/Study Materials.php')"><button >Assign Study Materials</button></a>
           <a href="#" onclick="loadpage('../php/Upload Task.php')"><button >Upload task</button></a>
           <a href="#" onclick="loadpage('../php/Grade.php')"><button > Student Grade</button></a>
           <a href="#" onclick="loadpage('../php/Student Submission.php')"><button >Student Submission</button></a>
           <a href="#" onclick="loadpage('../php/Send Annoucement.php')"><button >Send Annoucment</button></a> 
            </div>
        </div>
    
    
         <div  class="dropdown" style="float:right;">
            <img src="../../main/image/setting.png" alt="setting" style="width:50px; height:50px;" class="dropbtn">
            <div class="dropdown-content" style="right:0;">
              <button type="button" id="logout" onclick="document.location.href='../../main/logout.php'" >Logout</button>
         </div>
         </div>
         
         <div id="id2">
         <iframe id="idframe" style="width: 1300px;height: 500px;"></iframe>
       </div>
       </center>
    <script src="../js/aiub.js"></script>
    </body>
    </html>