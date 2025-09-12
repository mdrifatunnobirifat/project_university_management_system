<?php
include '../DB/registrationDB.php';
$sql="SELECT * FROM leaveapplication";
$result=$conn->query($sql);


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
             <label  style="color: rgb(13, 101, 202); font-family:Arial, Helvetica, sans-serif;  font-size: 25px;"> Manage leave Application</label><br>
             <label  style="color: rgb(22, 22, 22); ">************************************************</label>
        </h2>

        <div>
            <table class="table" style="color:black;font-size:20px;">
                <tr class="tablerow">
                    <td class="tableheading">ID</td>
                    <td class="tableheading">fullname</td>
                    <td class="tableheading">username</td>
                    <td class="tableheading">application</td>
                    <td class="tableheading">action</td> 
                </tr>

                <?php
                 if(mysqli_num_rows($result)>0)
                 {
                    while($row=$result->fetch_assoc())
                    {
                        echo "<tr class='tablerow'>";
                        echo "<td class='tableheading'>".$row['ID']."</td>";
                        echo "<td class='tableheading'>".$row['fullname']."</td>";
                        echo "<td class='tableheading'>".$row['username']."</td>";
                        echo "<td class='tableheading'>".$row['application']."</td>";
                        echo "<td class='tableheading' style='width:20px'><button style='width:20px;height:20px;padding:1px;border:none;margin:2px;'>accpet</button><br><button style='width:20px;height:20px;padding:1px;border:none'>decline</button></td>";
                        echo "</tr>";
                    }
                 }
                ?>

            </table>
        </div>
        </center>
    
   <!--     <button  onclick="document.location.href='Aiub .html'" id ="back">Back</button> -->
    </body>
</html>