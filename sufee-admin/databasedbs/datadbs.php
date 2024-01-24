<?php

if (!defined('UPLOAD_SRC')) {
    define("UPLOAD_SRC", $_SERVER['DOCUMENT_ROOT'] . "/kicks/sufee-admin/databasedbs/uploads/");
}

if (!defined('FETCH_SRC')) {
    define("FETCH_SRC", "http://127.0.0.1/databasedbs/uploads");
}

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "ecomregister";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}

?>
