<?php
include '../../main/DB/DB.php';
$query="SELECT ID,fullname,username,department,email FROM registration WHERE role='Student'";
$result=$conn->query($query);

 
if(isset($_POST['add']))//student add korbo
{
   $fullname=$_POST['fullname'];
 $username=$_POST['username'];
 $email=$_POST['email'];
  $password=$_POST['username'];
  $department=$_POST['department'];
    $check="SELECT * FROM registration WHERE username='$username' AND role='Student'";
    $resultcheck=mysqli_query($conn,$check);
    if(mysqli_num_rows($resultcheck)>0)
    {
        echo "<script>alert('there is a same username holder in database');</script>";
    }
    else
    {
        if(preg_match("/^[1-9]{2}-[0-9]{5}-[1-3]{1}$/",$username))
        {
         $hash_password=password_hash($password,PASSWORD_DEFAULT);
        $sql="INSERT INTO registration(fullname,username,role,department,email,password) VALUES('$fullname','$username','Student','$department','$email','$hash_password')";
        $sql1="INSERT INTO login(username,password) VALUES('$username','$hash_password')";
        mysqli_query($conn,$sql);
        mysqli_query($conn,$sql1);
        header("Location:".$_SERVER["PHP_SELF"]);
        exit();
        }
        else
          {
            echo "<script>alert('enter valid username(xx-xxxxx-x)');</script>";
          }

    }
}

if(isset($_POST['edit']))
{
    $fullname=$_POST['fullname'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $department=$_POST['department'];
    $sql="UPDATE registration SET fullname='$fullname',email='$email',department='$department' WHERE username='$username' AND role='Student'";
    mysqli_query($conn,$sql);
    header("Location:".$_SERVER["PHP_SELF"]);
    exit();
}


if(isset($_POST['delete']))
{
    $fullname=$_POST['fullname'];
   $username=$_POST['username'];
    $department=$_POST['department'];
  
   $sql="DELETE FROM registration WHERE  username='$username' AND role='Student'";
   $sql1="DELETE FROM login WHERE username='$username' ";
   mysqli_query($conn,$sql);
  mysqli_query($conn,$sql1);
   header("Location:".$_SERVER["PHP_SELF"]);
   exit();

}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>aiub clone</title>
        <link rel="stylesheet"  href="../css/aiub.css">
         <style>
            body
                {
                    background-image:url("../../main/image/manage user.jpg");
                    background-size:cover;
                    background-position:center;
                    background-repeat:no-repeat;
                }
        </style>
    </head>
    <body>
      <center>
         <h2>
             <label  style="color: rgb(13, 101, 202); font-family:Arial, Helvetica, sans-serif;  font-size: 25px;"> Manage student</label><br>
             <label  style="color: rgb(22, 22, 22); ">************************************************</label>
         </h2>
     
     <form method="post">
      <div id="div1">
         <form method="post">
        <div style="border:2px dashed black; width:300px;height:250px;" >
            <h3>Add student</h3>
            <br>
          
            <input type="text" name="fullname" placeholder="fullname"><br>
            <input type="text"  name="username" placeholder="username"><br>
            <input type="email" name="email" placeholder="email"><br>
            <select id="department" name="department">
                <option value="FST">FST</option>
                <option value="FEE">FEE</option>
                <option value="FBA">FBA</option>
            </select>
            <br>
           <br>
            <button type="submit" name="add"  style="width:60px;height:30px;padding:1px;font-size:13px;border-radius:4px; background-color:rgb(99,247,116);">Add</button>  
       </div>
</form>
 <form method="post">
        <div style="border:2px dashed black;width:300px;height:250px;">
        <h3>delete student</h3>
        <br>
        
            <input type="text"  name="username" placeholder="username"><br><br><br>


          
          <button type="submit" name="delete"  style="width:60px;height:30px;padding:1px;font-size:13px;border-radius:4px; background-color:rgb(250,122,102);">delete</button> 
        </div>
</form>
 <form method="post">
        <div  style="border:2px dashed black;width:300px;height:250px;">
            <h3>edit student in the list</h3><br>
            <input type="text" name="fullname" placeholder="fullname"><br>
            <input type="text"  name="username" placeholder="username"><br>
            <input type="email" name="email" placeholder="email"><br>
            <select id="department" name="department">
                <option value="FST">FST</option>
                <option value="FEE">FEE</option>
                <option value="FBA">FBA</option>
            </select>
            <br><br><br>
          <button type="submit" name="edit"  style="width:60px;height:30px;padding:1px;font-size:13px;border-radius:4px; background-color:rgb(250,240,105);">edit</button></td>
        </div>
</form>
         <!-- <p style="color:red;font-size:15px;">if you want to add then fill up all the inputs</p>
          <p style="color:red;font-size:15px;">if you want to edit you can edit only  the fullname and department and gmail</p>
          <p style="color:red;font-size:15px;">if you want to delete you must correctly enter the * usrname *</p>-->
                   
 </div>

  
          <form method="post">  
         <div>
            <table class="table" style="font-size:18px;">
                
                <tr class="tablerow">
                    <td class="tableheading">ID</td>
                    <td class="tableheading">Name</td>
                    <td class="tableheading">Userid</td>
                    <td class="tableheading">email</td>
                    <td class="tableheading">dept.</td>
             
                </tr>
            <?php
            if($result && $result->num_rows>0)
            {
                while ($row=$result->fetch_assoc())
                {
                     echo "<tr class='tablerow'>";  
                     echo "<td class='tableheading'>".$row['ID']."</td>";
                     echo "<td class='tableheading'>".$row['fullname']."</td>";
                     echo "<td class='tableheading'>".$row['username']."</td>";
                     echo "<td class='tableheading'>".$row['email']."</td>";
                     echo "<td class='tableheading'>".$row['department']."</td>";
                     echo "</tr>";

                }
                
            }
            else
            {
                echo "<tr><td colspan='4'>NO student found</td></tr>";
            }


            $conn->close();
            ?>

        </div>
        </table>
        </center>


        
        </form>
         
           <!-- <button  onclick="document.location.href='Aiub .html'" id="back">Back</button> -->
    </body>
</html>