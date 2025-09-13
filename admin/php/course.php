<?php
include  '../../main/DB/DB.php';

$tsql="SELECT username,fullname,department FROM registration WHERE role='Teacher' ";
$tresult=$conn->query($tsql);

$csql="SELECT course,date1,date2,time,section  FROM addcourse";
$cresult=$conn->query($csql);


$assigncourse=[];
if($cresult->num_rows >0)
{
    while($row=$cresult-> fetch_assoc())
    {
        $assigncourse[]=[ 'course'=>$row['course'],'section'=>$row['section']];
    }
}

$fullname=$username=$course=$department=$section="";
$fullname=$usernameerr=$courseerr=$departmenterr="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{   
    $fullname=$_POST['fullname'];
    $username=$_POST['username'];
    $course=$_POST['assigncourse'];
    $department=$_POST['department'];
}


function test_input($data)
{
    $data=trim($data);
    $data=htmlspecialchars($data);
    return $data;

}

if(isset($_POST['add']))
{
    $sql="INSERT INTO tcourse(username,fullname,department,assigncourse,section) VALUES('$username','$fullname','$department','$course','$section')";
    if($conn->query($sql)===TRUE)
    {
        echo "<script>alert('successfult assinged');</script>";
    }
    else{
        echo  "<script>alert('failed');</script>";
    }
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
                    <td class="tableheading">Username</td>
                    <td class="tableheading">Fullname</td>
                    <td class="tableheading">Department</td>
                    <td class="tableheading">Assinged course</td>
                    <td class="tableheading">Action</td>
               </tr>

                <?php
                if($tresult->num_rows>0 )
                {
                    $crow="SELECT course FROM addcourse;";
                    while($trow=$tresult->fetch_assoc())
                    {
                        
                        echo "<tr class='tablerow'>";
                        echo "<form method='post'>";
                        echo "<td class='tableheading'>".$trow['username']." <input type='hidden' name='username' value='".$trow['username']."'></td>";
                        echo "<td class='tableheading'>".$trow['fullname']."<input type='hidden' name='fullname' value='". $trow['fullname']."'></td>";
                        echo "<td class='tableheading'>".$trow['department']." <input type='hidden' name='department' value='".$trow['department']."'</td>";
                        echo "<td class='tableheading'><select  name='assigncourse'>select";
                        foreach($assigncourse as $c)
                        {
                         echo "<option value='".$c['course']."-".$c['section']."'>".$c['course']."-".$c['section']."</option>";
                         }
                        echo "</select></td>";

    
                         echo "<td class='tableheading'><button type='submit'name='add'style='width:20px;height:20px;padding:0;border:none'><img src='../../main/image/course_add_icon.png' alt='add'style='width:25px;height:25px;display:block;margin:auto;'></button></td>";
                       echo "</form>";
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