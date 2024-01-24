<?php
session_start();
include '../databasedbs/datadbs.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['signin'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            $_SESSION['status'] = "Please fill in all fields";
            header('Location: page-login.php');
            exit();
        }

        $log_query = "SELECT * FROM kicks WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $log_query)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user_data = mysqli_fetch_assoc($result);

            if ($user_data) {
                // Verify password
                if (password_verify($password, $user_data['password'])) {
                    // Password is correct, set session and redirect
                    $_SESSION['auth'] = true;
                    $_SESSION['auth_user'] = [
                        'user_id' => $user_data['id'],
                        'user_name' => $user_data['username'],
                        'user_email' => $user_data['email'],
                        'user_role' => $user_data['usertype'],
                    ];

                    $_SESSION['status'] = "Logged in successfully";

                    if ($user_data['usertype'] == 'admin') {
                        header('Location: index.php');
                        $_SESSION['status'] = "Admin Login Successful";
                        $_SESSION['status_code'] = "success";
                    } else {
                        header('Location: ../databasedbs/index.php');
                        $_SESSION['status'] = "User Login Successful";
                        $_SESSION['status_code'] = "success";
                    }
                } else {
                    // Incorrect password
                    $_SESSION['status'] = "Incorrect password";
                    header('Location: page-login.php');
                    exit();
                }
            } else {
                // User not found
                $_SESSION['status'] = "User not found";
                header('Location: page-login.php');
                exit();
            }
        } else {
            // Error in preparing statement
            $_SESSION['status'] = "Error in querying the database";
            header('Location: page-login.php');
            exit();
        }
    } else {
        echo "Sorry could not find any data!";
    }
}
?>


<!-- Your HTML code remains unchanged -->



<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sufee Admin - HTML5 Admin Template</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>



</head>

<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
        
            
            
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="images/logo.png" alt="">
                    </a>
        
                </div>
                <div class="login-form">
                <form action="page-login.php" method="post">
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                    <label>Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Password">
                     </div>
                    <?php if (!empty($errorMessage)) { echo "<div class='text-danger small'>$errorMessage</div>"; } ?>
                        <button type="submit" name="signin" class="btn btn-primary btn-flat m-b-30 m-t-30">Sign In</button>
                </form>

                                <div class="checkbox">
                                    <label>
                                <input type="checkbox"> Remember Me
                            </label>
                                    <label class="pull-right">
                                <a href="#">Forgotten Password?</a>
                            </label>

                                </div>
                                
                                <div class="social-login-content">
                                    <div class="social-button">
                                        <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Sign in with facebook</button>
                                        <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Sign in with twitter</button>
                                    </div>
                                </div>
                                <div class="register-link m-t-15 text-center">
                                    <p>Don't have account ? <a href="page-register.php"> Sign Up Here</a></p>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    


    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


</body>

</html>
