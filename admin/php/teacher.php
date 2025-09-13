<?php
include '../../main/DB/DB.php';
$query="SELECT  ID,fullname,username,department,email FROM registration WHERE role='Teacher'";
$result=$conn->query($query);


if(isset($_POST['delete']))
{
    $username=$_POST['username'];

    $sql="DELETE FROM registration Where username='$username' ";
    mysqli_query($conn,$sql);
    header("Location:".$_SERVER['PHP_SELF']);
    exit();

}

if(isset($_POST['edit']))
{
    
    $fullname=$_POST['fullname'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['username'];
    $department=$_POST['department'];
    $sql="UPDATE registration SET fullname='$fullname',email='$email',department='$department' WHERE username='$username' AND role='Teacher'";
    mysqli_query($conn,$sql);
    header("Location:".$_SERVER['PHP_SELF']);
    exit();

}

if(isset($_POST['add']))
{
    $fullname=$_POST['fullname'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['username'];
    $department=$_POST['department'];
    $check="SELECT * FROM registration WHERE username='$username' AND role='Teacher' LIMIT 1";
    $resultcheck=mysqli_query($conn,$check);
    if(mysqli_num_rows($resultcheck)>0)
    {
        echo "<script>alert('multiple input in the DB');</script>";
    }
    else
    {
    if(preg_match("/^[0-9]{4}-[0-9]{4}$/",$username)){
    $hash_password=password_hash($password,PASSWORD_DEFAULT);
    $sql="INSERT INTO registration(fullname,username, department,email,password,role) VALUES('$fullname','$username','$department','$email','$hash_password','Teacher') ";
    $sql1="INSERT INTO login(username,password) VALUES( '$username','$hash_password') ";

    mysqli_query($conn,$sql);
    mysqli_query($conn,$sql1);
    header("Location:".$_SERVER['PHP_SELF']);
    exit();
    }
    else
     {
        echo "<script>alert('enter valid  username(xxxx-xxxx)');</script>";
     }
   }
    
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
             <label  style="color: rgb(13, 101, 202); font-family:Arial, Helvetica, sans-serif;  font-size: 25px;"> Manage teacher</label><br>
             <label  style="color: rgb(22, 22, 22); ">************************************************</label>
          </h2>
     <div id="div1">
            <form method ="post">   
            <div style="border:2px dashed black;width:300px;height:250px;">
             <h3>Add teacher</h3>
                          
                <input type="text"  name="fullname"placeholder="fullname" ><br>
                <input type="text" name="username" placeholder="username"><br>
                 <input type="email" name="email" placeholder="email" ><br>
                 <select id="department" name="department">
                <option value="FST">FST</option>
                <option value="FEE">FEE</option>
                <option value="FBA">FBA</option>
              </select>
              <br><br>
               <button type ="submit" name="add" style="width:60px;height:30px;padding:1px;font-size:13px;border-radius:4px; background-color:rgb(99,247,116);">Add</button>  <br>
                </div>
                </form>
                 <!-- <input type="text" name="password" placeholder="password">-->
                
                 <form method="post">
                    <div style="border:2px dashed black;width:220px;height:250px;">
                     <h3>Edit info of teacher</h3>              
                      <input type="text"  name="fullname"placeholder="fullname" ><br>
                      <input type="text" name="username" placeholder="username"><br>
                      <input type="email" name="email" placeholder="email" ><br>
                       <select id="department" name="department">
                         <option value="FST">FST</option>
                         <option value="FEE">FEE</option>
                         <option value="FBA">FBA</option>
                      </select></br>
                      <br><br>
            
                  <button type ="submit" name="edit" style="width:60px;height:30px;padding:1px;font-size:13px;border-radius:4px; background-color:rgb(250,240,105);">Update</button> <br>
                </div>
                </form>

               <form method ="post">
                <div style="border:2px dashed black;width:300px;height:250px;">
                  <h3>Delete teacher</h3>             
                     <input type="text" name="username" placeholder="username"><br><br>
                <button type ="submit" name="delete" style="width:60px;height:30px;padding:1px;font-size:13px;border-radius:4px; background-color:rgb(250,122,102);">Delete</button> <br>
                </div>
               
             </form>
    </div>
            <form  method="post">
          <div>
            <table  class="table" style="font-size:18px;">
                
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
                    while($row=$result->fetch_assoc())
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
                        echo "<tr><td colspan='4'> NO teachers found</td></tr>";
                    }
                      $conn->close();
                             
             ?>
             </div>
             </table>
          </div>
         </form>
        </center>
    </body>
</html>