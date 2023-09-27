<?php
session_start();
error_reporting(0);

if(!isset($_SESSION['username']))
{
    header("location:login.php");
}
elseif($_SESSION['usertype']=='student')
{
    header("location:login.php");
}

$host="localhost:3307";
$user="root";
$password="";
$db="schoolproject";

$data=mysqli_connect($host,$user,$password,$db);

if($_GET['teacher_id'])
{
    $t_id=$_GET['teacher_id'];
    $sql="SELECT * FROM teacher WHERE id='$t_id'";

    $result=mysqli_query($data,$sql);

    $info=$result->fetch_assoc();
}


if(isset($_POST['update_teacher']))
{
    $t_name=$_POST['name'];
    $t_id=$_POST['id'];
    $t_des=$_POST['description'];
    
    // Check if a file is selected
    if($_FILES['image']['size'] > 0) {
        $file=$_FILES['image']['name'];
        $file_type = $_FILES['image']['type'];
        $allowed_types = array("image/jpeg", "image/jpg", "image/png");
        
        if(in_array($file_type, $allowed_types)){
            $dst="./image/".$file;
            $dst_db="image/".$file;
    
            move_uploaded_file($_FILES['image']['tmp_name'],$dst);
        } else {
            echo "<script type='text/javascript'>
                alert('Invalid file type. Please upload a JPG, JPEG, or PNG file.');
                window.location.href = 'admin_update_teacher.php?teacher_id=$t_id';
                </script>";
            exit();
        }
    } else {
        $dst_db = "{$info['image']}"; // Keep the old image
    }

    $sql2="UPDATE teacher SET name='$t_name', description='$t_des', image='$dst_db' WHERE id='$t_id'";
    
    $result2=mysqli_query($data,$sql2);

    if($result2){
        echo "<script type='text/javascript'>
        alert('Teacher Data Updated Successfully');
        window.location.href = 'admin_view_teacher.php';
        </script>";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    <?php

        include 'admin_css.php';
    ?>

    <style>
        
        label
        {
            display: inline-block;
            width: 150px;
            text-align: right;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .form_deg
        {
            background-color: skyblue;
            width: 600px;
            padding-top: 70px;
            padding-bottom: 70px;
        }



    </style>

</head>
<body>
   
<?php
   
   include 'admin_sidebar.php';
   ?>
   
    <div class="content">
        <center>

        <h1>Update Teacher Data</h1>

        <form class="form_deg" action="#" method="POST" enctype="multipart/form-data">

        <input type="text" name="id" value="<?php echo "{$info['id']}" ;?>" hidden>

        <div>
            <label>Teacher Name</label>
            <input type="text" name="name" value="<?php echo "{$info['name']}" ;?>">
        </div>
        
        <div>
            <label>About Teacher</label>
            <textarea type="text" name="description" ><?php echo "{$info['description']}" ;?>
        
        </textarea>
        </div>

        <div>
            <label>Teacher Old Image</label>
            <img height="100px" width="100px" src="<?php echo "{$info['image']}" ;?>">
        </div>

        <div>
            <label>Choose Teacher New Image</label>
            <input type="file" name="image" accept=".jpg, .jpeg, .png">

            <div>
                    <small style="color: red;">(Accepted file types: JPG, JPEG, PNG)</small>
                    </div>

        </div>

        <div>
            <input class="btn btn-success" type="submit" name="update_teacher">
        </div>

        </form>
        </center>

    

    </div>
</body>
</html>