<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</head>
<body background="school2.jpg" class="body_deg">
    <center>


    <div class="form_deg">
        <center class="title_deg">
            Login with your Credential

            <h4>
                <?php
                
                error_reporting(0);
                session_start();
                session_destroy();
                echo $_SESSION['loginMessage'];
                ?>
            </h4>
        </center>


        <form action="login_check.php" method="POST" class="login_form">
            <div>
                <label class="label_deg">Username</label>
                <input type="text" name="username">
            </div>

            <div>
                <label class="label_deg">Password</label>
                <input type="Password" name="password">
            </div>

            <div>
                <input class="btn btn-primary" type="submit" name="submit" value="Login">
            </div>
            <br>

            <div>
            
                <h5><i class="fas fa-home"></i>
                    <a href="index.php">Back to Home</a></h5>
            </div>
        </form>

    </div>
    </center>
</body>
</html>