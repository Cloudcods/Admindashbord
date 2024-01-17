
<?php
$conn=mysqli_connect("localhost","root","","ecomregister");
if(!$conn){
    die("connection error");
}


//require_once('../../databasedbs/config.php'); 
$query = "SELECT * from kicks";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crud</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Admin Profile
                <button type="button" href="kicks/sufee-admin/sufee-admin-dashboard/page-register.php" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                    Add my Profile
                </button>
            </h6>
        </div>
        
        <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Usertype</th>
                <th>Edit</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch and display data from the database
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id']; // Define $id based on the current row
                $username = $row['username'];
                $email = $row['email'];
                $password = $row['password'];
                $usertype =$row['usertype'];
            ?>
                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $username; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $password; ?></td>
                    <td><?php echo $usertype; ?></td>
                    <td>
                    <form action=""method="post">
                        <button  type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">
                            <a href="update.php?rowid=<?php echo $id; ?>" class="text-light">Edit</a>
                        </button> 
            </form>
                    </td>
                        <?php
                        if(isset($_POST['delete'])){
 
    $sql = "DELETE FROM kicks WHERE id = $id";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo "deleted succesfully";
        header("Location: adminprofile.php");
        
    }else{
        echo"error!something wrong?";
    }
    }
    ?>
    <td>
<form action="adminprofile.php"method="post">
                        <button type="submit" name="delete"class="btn btn-danger btn-flat m-b-30 m-t-30"
                            class="text-light">Delete</button>
</form>

</td>              


                        

                    
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

        </div>
    </div>
</div>

</body>
</html>
