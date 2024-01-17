<?php
include('../databasedbs/datadbs.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
            $emptyError = "Please enter all the details!";
        }

        if (isset($_POST['username'])) {
            $user = $_POST['username'];
            if (preg_match('/[#@!$%^&*()\-_+=<>?.,:;\'"\/\\[\]{}`~|\s]/', $user)) {
                $usernameError = "Username Must not have any spaces or special characters!";
            }
        }

        if (isset($_POST['password'])) {
            $pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^\w\d\s]).{8,}$/';
            $passwordGood = preg_match($pattern, $password);
            if (!$passwordGood) {
                $passwordError = "Password must have one uppercase letter, one lowercase letter, one number and one special character!";
            }
        }
    } else {
        echo "Sorry could not find any data!";
    }

    $errors = array(
        'username' => '',
        'email' => '',
        'password' => '',
        'passwordverify' => '',
    );

    $sql = "SELECT * FROM kicks WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $errors['email'] = "Email already exists!";
        }
    }

    if (empty($errors['username']) && empty($errors['email']) && empty($errors['password'])) {
        $sql = "INSERT INTO kicks (username, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $passwordHash);

            if (mysqli_stmt_execute($stmt)) {
                header('location:page-login.php');
                echo "<div class='alert alert-success'><p>You are registered successfully. <a href='page-login.php'>Login</a></p></div>";
            } else {
                echo "<div class='alert alert-danger'><p>Registration failed. Please try again.</p></div>";
            }
        } else {
            die("Something went wrong");
        }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">



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
                <form action="page-register.php" method="post">
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" name="username" class="form-control" placeholder="User Name">
                        </div>
                        <?php if(isset($usernameError)){echo "<div class='text-danger small'>$usernameError</div>";} ?>

                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                   
                        </div>
                        <?php if(isset($passwordError)){echo "<div class='text-danger text-center small'>$passwordError</div>";} ?>
                        <?php if(isset($emptyError)){echo "<div class='text-danger small' role='alert'>$emptyError</div>";}?>

                                    <div class="checkbox">
                                        <label>
                                <input type="checkbox"> Agree the terms and policy
                            </label>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Register</button>
                                    <div class="social-login-content">
                                        <div class="social-button">
                                            <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Register with facebook</button>
                                            <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Register with twitter</button>
                                        </div>
                                    </div>
                                    <div class="register-link m-t-15 text-center">
                                        <p>Already have account ? <a href="page-login.php"> Sign in</a></p>
                                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    //const togglePassword = document.getElementById('togglepassword');
    //const password = document.getElementById('password');
    
    //togglePassword.addEventListener('click', function () {
       /// const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
       // password.setAttribute('type', type);
  //  });
</script>


    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


</body>

</html>
