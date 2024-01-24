<?php
require("datadbs.php");

function image_upload($img)
{
    $kicksDirectory = $_SERVER['DOCUMENT_ROOT'] . "/kicks/sufee-admin/databasedbs/";
    $uploadDirectory = $kicksDirectory . "uploads/";

    // Check if the kicks directory exists, create it if not
    if (!file_exists($kicksDirectory)) {
        mkdir($kicksDirectory, 0777, true);
    }

    
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    // File type validation
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif','image/jpg'];

    if (!in_array($img['type'], $allowedTypes)) {
        echo "Invalid file type.";
        exit();
    }

    // Move uploaded file
    $tmp_loc = $img['tmp_name'];
    $new_name = random_int(11111, 99999) . $img['name'];
    $new_loc = $uploadDirectory . $new_name;

    echo "New Location: " . $new_loc . "<br>";
    echo "Is Writable: " . (is_writable($uploadDirectory) ? 'Yes' : 'No') . "<br>";

    if (!move_uploaded_file($tmp_loc, $new_loc)) {
        echo "Error moving file.";
        exit();
    } else {
        return $new_name;
    }
}
function image_remove($img) {
    if(!unlink(UPLOAD_SRC . $img)){

        header("location:../sufee-admin-dashboard/tables-basic.php?alert=img_rem_failed");
        exit;
    }
}


if (isset($_POST['addproduct'])) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = mysqli_real_escape_string($conn, $value);
    }

    $imgpath = image_upload($_FILES['image']);

    // Use prepared statements to prevent SQL injection
    $query = "INSERT INTO `products`(`name`, `price`, `description`, `image`)
              VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $_POST['name'], $_POST['price'], $_POST['desc'], $imgpath);

    if (mysqli_stmt_execute($stmt)) {
        echo "success";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}
if (isset($_GET['rem']) && $_GET['rem']>0)
{
    $query="SELECT * FROM `PRODUCTS`WHERE `id`='$_GET[rem]'";
    $result=mysqli_query($conn,$query);
    $fetch=mysqli_fetch_assoc($result);
    image_remove($fetch['image']);
    $query="DELETE FROM `products`WHERE`id`='$_GET[rem]'";
    if(mysqli_query($conn,$query)){
        header("location:../sufee-admin-dashboard/tables-basic.php?success=removed");
    }
    else{
        header("location:../sufee-admin-dashboard/tables-basic.php?alert=removed_failed");

    }
}
if (isset($_POST['editproduct'])) {

foreach($_POST as $key=>$value){
$_POST[$key]=mysqli_real_escape_string($conn,$value);
}

if(file_exists($_FILES['image']['tmp_name'])||is_uploaded_file($_FILES['image']['tmp_name'])){
    $query = "SELECT * FROM `products` WHERE `id`='$_POST[editpid]'";
    $result = mysqli_query($conn, $query);
    $fetch = mysqli_fetch_assoc($result);
    image_remove($fetch['image']);
   $imgpath=image_upload($_FILES['image']);
   $update="UPDATE `products` SET `name`='$_POST[name]',`price`='$_POST[price]',
   `description`='$_POST[desc]',`image`= '$imgpath' WHERE `id`='$_POST[editpid]'";
}
else{
    $update="UPDATE `products` SET `name`='$_POST[name]',`price`='$_POST[price]',
    `description`='$_POST[desc]' WHERE `id`='$_POST[editpid]'";
}
if(mysqli_query($conn,$update)){
    header("location:../sufee-admin-dashboard/tables-basic.php?success=updated");
}
else{
    header("location:../sufee-admin-dashboard/tables-basic.php?alert=updated_failed");
}
}


?>
