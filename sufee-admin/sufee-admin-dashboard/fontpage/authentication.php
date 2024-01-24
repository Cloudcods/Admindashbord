<?php
session_start();
if(!isset($_SESSION['auth']))
{
    $_SESSION['auth_status']="login to Access dashboard";
    header("location:page-login.php");
    exit(0);
}
else
{
    if($_SESSION['auth']=="1")
    {
        header("location:page-login.php");
    }
    else
    {
        $_SESSION['auth_status']="you are not authorized";
    header("location:../index.php");
    exit(0);
    }

}
?>