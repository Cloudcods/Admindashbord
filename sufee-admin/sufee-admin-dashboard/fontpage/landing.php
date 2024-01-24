<form method="post" action="">
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Profile
                <button type="button" href="kicks/sufee-admin/sufee-admin-dashboard/page-register.php" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                    view my edit Profile
                </button>
            </h6>
        </div>
        <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" placeholder="username" name="username" value="<?php echo $username; ?>">
        <span class="error"><?php echo $usernameErr; ?></span>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" class="form-control" placeholder="email" name="email" value="<?php echo $email; ?>">
        <span class="error"><?php echo $emailErr; ?></span>
    </div>

    <div class="form-group"class="form-control">
        <label for="password">USERTYPE:</label>
        <select  name="usertype">
            <option value="admin">Admin</option>
            <option value="user">user</option>
    </div>

    <div class="form-btn"><br>
    <input type="submit" class="btn btn-primary" value="update" name="update"></button>
    </div>
</form>
</body>
</html>
<?php
session_start();
include '../fontpage/authentication.php';

if(isset($_POST["signin"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role_as=$row['role_as'];
    require_once "../databasedbs/datadbs.php";
    $sql = "SELECT * FROM kicks WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    

    $_SESSION['auth']="role_as";
    $_SESSION['auth_user']=[
        'email'=>$email,
        'password'=>$password,

    ];

   

if ($user) {
    if (password_verify($password, $user["password"])) {
        // Retrieve the role_as value from the $user array
        $role_as = $user['role_as'];

        // Store user information and role_as in session variables
        $_SESSION["user"] = "yes";
        $_SESSION['auth'] = $role_as;
        $_SESSION['auth_user'] = [
            'email' => $email,
            'password' => $password,
            'role_as' => $role_as,  // Add the role_as to the session data
        ];

        header("Location: index.php");
        die();
    } else {
        $_SESSION['error'] = "Password does not match";
        header("Location: page-login.php");
        die();
    }
} else {
    $_SESSION['error'] = "Email does not match";
    header("location:page-login.php");
    die();
}
}
?>

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
            <?php
               include('fontpage/message.php'); 
            ?>
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
