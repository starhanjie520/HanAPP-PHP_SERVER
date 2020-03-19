<?
include_once 'db.php';
  
$get_type = $_GET['get_type'];

$telephonenumber = $_GET['telephonenumber'];
$username = $_GET['username'];
$idcardnunber = $_GET['idcardnunber'];
$policVerify = $_GET['policVerify'];
$webchatopenid = $_GET['openid'];
// echo $get_type;
// echo "</br>";


if($get_type =='openidexist'){
	$openidExist = false;
    $sql = mysqli_query($dblink,"SELECT * FROM user")or die("datebse error!!!!");
    while($row = mysqli_fetch_array($sql))
    {
      $openidlen =  strlen($row[webchatopenid]) ;
      if($openidlen>1){
        $openidExist = true;
      break;
       }else{
        $openidExist = false;
          
    }
   }
   if($openidExist){
    $sql="UPDATE user SET lastuse_time=now() , use_count=use_count+1 WHERE webchatopenid = '$webchatopenid'";
    $sqls = mysqli_query($dblink, $sql);
    echo "exist:";
    }else{   
    echo "none";
   }
}

if($get_type =='webchat_register'){
	
	$openidExist = false;
    $sql = mysqli_query($dblink,"SELECT * FROM user")or die("datebse error!!!!");
    while($row = mysqli_fetch_array($sql))
    {
      $openidlen =  strlen($row[webchatopenid]) ;
      if($openidlen>1){
          $openidExist = true;
      break;
       }else{
         $openidExist = false;
    } 
   }
   if($openidExist){
    echo "exist:";
}else{   
    $insertSql="INSERT INTO user (telephonenumber,webchatopenid,username,idcardnunber,policVerify,register_time)  VALUES ('$telephonenumber','$webchatopenid','$username','$idcardnunber','$policVerify',now())";
    $sqls = mysqli_query($dblink, $insertSql);  
    echo "success";
}

}

?>
