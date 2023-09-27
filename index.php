<?php
error_reporting(0);
session_start();
session_destroy();

if($_SESSION['message']){
    $message=$_SESSION['message'];

    echo "<script type='text/javascript'>
    
    alert('$message');
    <
    /script>";
}

$host="localhost:3307";
$user ="root";
$password ="";
$db="schoolproject";

$data=mysqli_connect($host,$user,$password,$db);

$sql="SELECT * FROM teacher";

$result=mysqli_query($data,$sql);




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body>
<nav>
    <label class="logo">W-School</label>

    <ul>
        <li><a href="">Home</a></li>
        <li><a href="">Contact</a></li>
        <li><a href="#admission">Admission</a></li>
        <li><a href="login.php" id="lgn" class="btn btn-success">Login</a></li>

    </ul>
</nav>
<div class="section1">
    <label class="img_text">We Teach Students With Care</label>

<img class="main_img" src="school_management.jpg">
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img class="welcome_img" src="school2.jpg">
        </div>
        <div class="col-md-8">
        <h1>Welcome to W-School</h1>
        <p>MEMS has been committed to global learning long before it became an indispensable feature of contemporary education. Established in 1997, we proudly stand as the 1st English medium school in Bangladesh to adopt both Pearson Edexcel and Cambridge curriculum (in O and A levels), drawing together students in a vibrant, academically challenging, and encouraging environment where manifold viewpoints are prized and celebrated.MEMS has been committed to global learning long before it became an indispensable feature of contemporary education. Established in 1997, we proudly stand as the 1st English medium school in Bangladesh to adopt both Pearson Edexcel and Cambridge curriculum (in O and A levels), drawing together students in a vibrant, academically challenging, and encouraging environment where manifold viewpoints are prized and celebrated.</p>
        </div>
    </div>
</div>
<center>
    <h1>Our Teacher</h1>
</center>
<div class="container">
    <div class="row">
    <?php
    while($info=$result->fetch_assoc())

    {

    
    ?>

        <div class="col-md-4">

        <img class="teacher" src="<?php echo "{$info['image']}"?>">
        <h3><?php echo "{$info['name']}"?></h3>

        <h5><?php echo "{$info['description']}"?></h5>

        </div>

        <?php

    }
    ?>

        
    </div>
</div>


<center>
    <h1>Our Courses</h1>
</center>
<div class="container">
    <div class="row">
        <div class="col-md-4">

        <img class="teacher" src="web.jpg">
        <h3>Web Development</h3>
        </div>

        <div class="col-md-4">

        <img class="teacher" src="graphic.jpg">

        <h3>Graphic Design</h3>



        </div>
        <div class="col-md-4">

        <img class="teacher" src="marketing.png">

        <h3>Marketing</h3>


        </div>

    </div>

</div>

<center>
    <h1 class="adm" id="admission">Admission Form</h1>
</center>

<div align="center" class="admission_form">

<form action="data_check.php" method="POST">
    <div class="adm_int">
        <label class="label_text">Name</label>
        <input class="input_deg" type="text" name="name" required> 
    </div>


    <div class="adm_int">
    <label class="label_text">Email</label>
        <input class="input_deg" type="text" name="email" required> 
    </div>


    <div class="adm_int">
    <label class="label_text">Phone</label>
        <input class="input_deg" type="number" name="phone" maxlength="10" required> 
    </div>

    <div class="adm_int">
    <label class="label_text">Message</label>
        <textarea class="input_txt" name="message"></textarea>
    </div>

    <div class="adm_int">
    
        <input class="btn btn-primary" id="submit" type="submit" value="Apply" name="apply"> 
    </div>
</form>
</div>
        <footer>
            <h6 class="footer_text">All @copyright reserved by Toimoddin Saikh</h6>
        </footer>
</body>
</html>