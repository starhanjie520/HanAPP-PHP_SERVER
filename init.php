<?
include_once 'db.php';

$ctable="CREATE TABLE IF NOT EXISTS `user` (
	`telephonenumber` varchar(50) NOT NULL,
	`password` varchar(50) NOT NULL,
	`username` varchar(50) NOT NULL,
	`idcardnunber` varchar(50) NOT NULL,
	`webchatopenid` varchar(50) NOT NULL,
	`policVerify` varchar(50) NOT NULL,
	`register_time` datetime NOT NULL,
	`lastuse_time` datetime NOT NULL,
	`use_count` int(10) NOT NULL
  )";
mysqli_query($dblink, $ctable);
mysqli_close($dblink);
?>
