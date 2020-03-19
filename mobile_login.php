<?
include_once 'db.php';

$get_type = $_GET['get_type'];

$telephonenumber = $_GET['telephonenumber'];
$password = $_GET['password'];

if($get_type =='login'){
    $sql = "SELECT * FROM user WHERE telephonenumber = 01053869009";
   
    $initpro = mysqli_query($dblink, $sql);
    $row = mysqli_fetch_array($initpro);
    $ppaswd=$row['password'];
    echo "loginfail";
    $str = strcmp($password,$ppaswd);
    if(!$str){
        echo "loginsuccess";
    }else{
        echo "loginfail";
    }  
}
?>