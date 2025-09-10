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
            <table calss="table" styel="width:1200px;">
                <tr calss="tablerow">
                    <td class="tableheading">ID</td>
                    <td class="tableheading">fullname</td>
                    <td class="tableheading">username</td>
                    <td class="tableheading">application</td>
                </tr>

                <?php
                 if(mysqli_num_rows($result)>0)
                 {
                    while($row=$result->fetch_assoc())
                    {
                        echo "<td class='tablerow'>";
                        echo "<td class='tableheading'>".$row['ID']."</td>";
                        echo "<td class='tableheading'>".$row['fullname']."</td>";
                        echo "<td class='tableheading'>".$row['username']."</td>";
                        echo "<td class='tableheading'>".$row['application']."</td>";
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