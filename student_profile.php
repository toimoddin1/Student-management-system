<?php
session_start();

if(!isset($_SESSION['username']))

{
    header("location:login.php");
}

elseif($_SESSION['usertype']=='admin')
{
    header("location:login.php");
}

$host="localhost:3307";

$user="root";

$password="";

$db="schoolproject";


$data=mysqli_connect($host,$user,$password,$db);

$uname=$_SESSION['username'];
$sql="SELECT * FROM user WHERE username='$uname'";
$result=mysqli_query($data,$sql);

$info=mysqli_fetch_assoc($result);


if(isset($_POST['update_profile'])) {
    $uname=$_POST['uname'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $password=$_POST['password'];
    $id = $info['id']; 

    $sql2 = "UPDATE user SET username=?, name=?, email=?, phone=?, password=? WHERE id=?";
    $stmt = mysqli_prepare($data, $sql2);
    mysqli_stmt_bind_param($stmt, "sssssi", $uname, $name, $email, $phone, $password, $id); 
    $result2 = mysqli_stmt_execute($stmt);

    if($result2) 
    {
        echo " <script type='text/javascript'>
        alert('Data Updated Successfully')

        window.location.href = 'studenthome.php';
        </script>";

       
    }  else {
        echo " <script type='text/javascript'>
        alert('Data Updation Failed')
        </script>";
    }
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    
    <?php
include 'student_css.php'

    ?>

    <style type="text/css">

        label{
            display: inline-block;
            text-align: right;
            width: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .div_deg
        {
            background-color: skyblue;
            width: 500px;
            padding-top: 70px;
            padding-bottom: 70px;
        }
    </style>
</head>
<body>
   
    <?php
include 'student_sidebar.php'

    ?>

    <div class="content">
        <center>
            <h1>Update Profile</h1>
            <br><br>
            

    <form action="#" method="POST"> 
        <div class="div_deg">

    <div>
            <label>Username</label>
            <input type="text" name="uname" value="<?php echo "{$info['username']}" ;?>" readonly>
        </div> 

        <div>
            <label>Name</label>
            <input type="text" name="name" value="<?php echo "{$info['name']}" ;?>">
        </div> 
        
        <div>
            <label>Email</label>
            <input type="email" name="email" value="<?php echo "{$info['email']}" ;?>">
        </div> 

        <div>
            <label>Phone</label>
            <input type="number" name="phone" value="<?php echo "{$info['phone']}" ;?>">
        </div> 

        <div>
            <label>Password</label>
            <input type="text" name="password" value="<?php echo "{$info['password']}" ;?>">
        </div> 

        <div>
            
            <input class="btn btn-primary" type="submit" name="update_profile" value="Update">
        </div> 
        </div>
    </form>   

    </center>


    </div>
</body>
</html>