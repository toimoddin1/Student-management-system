<?php

session_start();

$host="localhost:3307";
$user="root";
$password="";
$db="schoolproject";

$data=mysqli_connect($host,$user,$password,$db);

if($_GET['student_id'])

{
    $user_id=$_GET["student_id"];
    $sql="DELETE FROM user WHERE id='$user_id' ";

    $result=mysqli_query($data,$sql);

    if ($result) {
        $_SESSION['message'] = '<p style="color: red; background-color: yellow; padding: 10px; border: 1px solid orange;">Student Data Deleted Successfully</p>';
        header("location:view_student.php");
    }
}




?>