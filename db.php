<?php
$db_host = 'localhost';
$db_user = 'test01';
$db_pass = 'hanjiasdf';
$db_name = 'test01';
$dblink = mysqli_connect($db_host, $db_user, $db_pass)or die("database connect error!");
$select_db = @mysqli_select_db($dblink, $db_name)or die("database select db error!");


?>
