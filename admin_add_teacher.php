<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location:login.php");
} elseif ($_SESSION['usertype'] == 'student') {
    header("location:login.php");
}

$host = "localhost:3307";
$user = "root";
$password = "";
$db = "schoolproject";

$data = mysqli_connect($host, $user, $password, $db);

if (isset($_POST['add_teacher'])) {

    $t_name = $_POST['name'];
    $t_description = $_POST['description'];

    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['image']['name'];
        $file_extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        $allowed_extensions = array('jpg', 'jpeg', 'png', );

        if (in_array($file_extension, $allowed_extensions)) {
            $dst = "./image/" . $file;
            $dst_db = "image/" . $file;

            move_uploaded_file($_FILES['image']['tmp_name'], $dst);

            $sql = "INSERT INTO teacher (name,description,image) VALUES ('$t_name', '$t_description', '$dst_db')";
            $result = mysqli_query($data, $sql);

            if ($result) {
                echo "<script type='text/javascript'>
                alert('Teacher Added Successfully')
                window.location.href = 'admin_add_teacher.php';
                </script>";
            } else {
                echo "Error: " . mysqli_error($data);
            }
        } else {
            echo "<script type='text/javascript'>
            alert('Invalid file type. Only JPG, JPEG, PNG files are allowed.')
            window.location.href = 'admin_add_teacher.php';
            </script>";
        }
    } else {
        echo "Error uploading file. Error code: {$_FILES['image']['error']}";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <style type="text/css">

        .div_deg{
            background-color: skyblue;
            padding-top: 70px;
            padding-bottom: 70px;
            width: 500px;
        }

    </style>
    
    <?php

        include 'admin_css.php';
    ?>



</head>
<body>
   
<?php
   
   include 'admin_sidebar.php';
   ?>
   
    <div class="content">
<center>
        <h1>Add Teacher</h1>
        <br>
        <br>


        <div class="div_deg">
            <form action="#" method="POST" enctype="multipart/form-data">
                <div>
                    <label>Teacher Name :</label>
                    <input type="text" name="name" required>
                </div>

                <br>

                <div>
                    <label>Description :</label>
                    <textarea name="description" required></textarea>
                </div>
                <br>


                <div>
                    <label>Image :</label>
                    <input type="file" name="image" accept=".jpg, .jpeg, .png" required>
                    <div>
                    <small style="color: red;">(Accepted file types: JPG, JPEG, PNG)</small>
                    </div>
                </div>
                <br>


                <div>
                    <input type="submit" name="add_teacher" value="Add Teacher" class="btn btn-primary">
                </div>
            </form>
        </div>

</center>

    </div>
</body>
</html>