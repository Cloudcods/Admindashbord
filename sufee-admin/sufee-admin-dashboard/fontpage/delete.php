<?php
include'../../databasedbs/datadbs.php';

if(isset($_GET['rowid'])){
    $id = $_GET['rowid'];


    $sql = "DELETE FROM kicks WHERE id = $id";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo "deleted succesfully";
    }else{
        header('location:adminprofile.php');
        echo"error!something wrong?";
    }
}
?>

