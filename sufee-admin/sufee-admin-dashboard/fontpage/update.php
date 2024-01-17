<?php


include '../../databasedbs/datadbs.php';
// Define variables and set to empty values
$usernameErr = $emailErr = $passwordErr = "";
$username = $email = $password = "";

$user_id = $_GET['rowid'];
    echo $user_id;

// Function to sanitize input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Username
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = sanitize_input($_POST["username"]);
        // Additional validation if needed
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = sanitize_input($_POST["email"]);
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Validate Password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = sanitize_input($_POST["password"]);
        // Validate password strength
        if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^a-zA-Z0-9]/', $password)) {
            $passwordErr = "Password should be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one digit, and one special character";
        }
    }

    // If there are no errors, you can proceed with further processing
    if (empty($usernameErr) && empty($emailErr) && empty($passwordErr)) {
        // Perform your update logic here

        // For example, you can display a success messa   

}
}


// Fetch the row ID from the URL
$id = isset($_GET['rowid']) ? $_GET['rowid'] : null;


 // Fetch the data of the specific row to pre-fill the form
$select_query = "SELECT * FROM kicks WHERE id = '$id'";
$result = mysqli_query($conn, $select_query);



if($result){
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$username = $row['username'];
$email = $row['email'];

}else{
    echo "Failed to fetch Data";
}

if(isset($_POST['update'])){
    $u_id = $user_id;
    echo $u_id;
    $username = $_POST['username'];
    $email = $_POST['email'];
    $update_query = "UPDATE kicks SET username = '$username', email = '$email' WHERE id  = '$u_id'";
    $update_query_run = mysqli_query($conn, $update_query);
    if($update_query_run){
        echo " Updated Successfully !";
        header("location:adminprofile.php");
    }else{
        echo " Failed !";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="nap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>

<!-- HTML form with PHP validation -->
<form method="post" action="">
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Admin Profile
                <button type="button" href="kicks/sufee-admin/sufee-admin-dashboard/page-register.php" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                    Add my Profile
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

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="error"><?php echo $passwordErr; ?></span>
    </div>

    <div class="form-btn">
    <input type="submit" class="btn btn-primary" value="update" name="update"></button>
    </div>
</form>
</body>
</html>