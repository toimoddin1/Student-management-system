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

$sql="SELECT * FROM user WHERE usertype='student' ";

$result=mysqli_query($data,$sql);

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

    <style type="text/css">

        .table_td
        {
            border: 1px solid black;
            font-size: 20px;
            padding: 20px;
            background-color: skyblue;
        }

    </style>
</head>
<body>
   
<?php
   
   include 'admin_sidebar.php';
   ?>
   
    <div class="content">

    <center>

        <h1>Students Data</h1>

        <?php
        if($_SESSION['message'])

        {
            echo ($_SESSION['message']);
        }
        unset($_SESSION['message']);
        
        ?>
        <br><br>

        <table>
        <tr>
        <th class="table_th" style="border: 1px solid black; padding: 20px; font-size: 20px;">Userame</th>
        <th class="table_th" style="border: 1px solid black; padding: 20px; font-size: 20px;">Name</th>
        <th class="table_th" style="border: 1px solid black; padding: 20px; font-size: 20px;">Email</th>
        <th class="table_th" style="border: 1px solid black; padding: 20px; font-size: 20px;">Phone</th>
        <th class="table_th" style="border: 1px solid black; padding: 20px; font-size: 20px;">Password</th>
        <th class="table_th" style="border: 1px solid black; padding: 20px; font-size: 20px;">Delete</th>
        <th class="table_th" style="border: 1px solid black; padding: 20px; font-size: 20px;">Update</th>


    </tr>

    <?php
    
    while($info =$result-> fetch_assoc())
    {

    
    ?>
<tr>
    <td class="table_td">
        <?php echo " {$info['username']}"; ?>
    </td>
    <td class="table_td">
        <?php echo " {$info['name']}"; ?>
    </td>
    <td class="table_td">
        <?php echo " {$info['email']}"; ?>
    </td>
    <td class="table_td">
        <?php echo " {$info['phone']}"; ?>
    </td>
    <td class="table_td">
        <?php echo " {$info['password']}"; ?>
    </td>
    <td class="table_td">
        <?php echo " <a  class ='btn btn-danger' onClick=\" javascript:return confirm('Are You sure to Delete this'); \" 
        href='delete.php?student_id={$info['id']}'>Delete </a>"; ?>
    </td>

    <td class="table_td">
        <?php echo " <a class='btn btn-primary' 
        href='update_student.php?student_id={$info['id']}'> Update</a>"; ?>
    </td>

</tr>
<?php
    }
?>

        </table>

        </center>

    

    </div>
</body>
</html>