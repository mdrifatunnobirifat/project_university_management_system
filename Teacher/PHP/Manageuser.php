<?php
include '../DB/register.php';


$sql="SELECT * FROM registration WHERE role='Student'";
$result=mysqli_query($conn,$sql); 

?>

<!DOCTYPE html>
<html>
    <head>
        <title>AIUB Clone - All Users</title>
        <link rel="stylesheet" href="../CSS/teacher.css">
    </head>
    <body>
        <center>
        <h2>
             <label style="color: rgb(13, 101, 202); font-family:Arial, Helvetica, sans-serif; font-size: 25px;">VIEW ALL USERS</label><br>
             <label style="color: rgb(22, 22, 22);">************************************************</label>
        </h2>
    
        <div id="id1">
            <table style="width: 100%; background-color: white; border-collapse: collapse;">
                <tr style="background-color: rgb(44, 200, 205);">
                    <th style="padding: 10px; border: 1px solid #ddd;">ID</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Name</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Email</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Role</th>
                </tr>
                <?php
                if(mysqli_num_rows($result)>0)
                {
                    while($row=mysqli_fetch_assoc($result))
                    {
                        echo "<tr>";
                        echo "<td style='padding: 10px; border: 1px solid #ddd;'>".$row['ID']."</td>";
                        echo "<td style='padding: 10px; border: 1px solid #ddd;'>".$row['fullname']."</td>";
                        echo "<td style='padding: 10px; border: 1px solid #ddd;'>".$row['email']."</td>";
                        echo "<td style='padding: 10px; border: 1px solid #ddd;'>".$row['role']."</td>";
                      
                        echo "</tr>";
                    }
                }
                else
                {
                    echo "<tr><td colspan='5' style='padding: 10px; border: 1px solid #ddd;'>No record found</td></tr>";
                }
               ?>
            </table>
        </div>
        </center>
    </body>
</html>