<?php
session_start();
header("Content-Type:text/html;charset=utf-8");
$username = $_POST['username'];
$userpass = $_POST['userpass'];
if($username == "admin" && $userpass == "admin"){
    $_SESSION['username'] = $username;
    header("Location:index.php");
} else {
    header("Location:login.html");
}

if($_GET['action'] == "logout"){
    unset($_SESSION['username']);
   // echo "logout";
}
?>