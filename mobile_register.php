<?
include_once 'db.php';

$get_type = $_GET['get_type'];

$telephonenumber = $_GET['telephonenumber'];
$password = $_GET['password'];
$username = $_GET['username'];
$idcardnunber = $_GET['idcardnunber'];
$policVerify = $_GET['policVerify'];

// echo $get_type;
// echo "</br>";


if($get_type =='register'){
	
	$userRegistState = false;
    $sql = mysqli_query($dblink,"SELECT * FROM user")or die("datebse error!!!!");

    while($row = mysqli_fetch_array($sql))
    {
      $str = strcmp($telephonenumber,$row[telephonenumber]);
	   if($str){                                                 // 사용가능 아이디
        $userRegistState = false; 
	   }else{                                                    //사용 불가능
        $userRegistState =true; 
        break;
          }
   }
   if($userRegistState){
       echo "existid";
   }else{   
       $insertSql="INSERT INTO user (telephonenumber,password,username,idcardnunber,policVerify)  VALUES ('$telephonenumber','$password','$username','$idcardnunber','$policVerify')";
       $sqls = mysqli_query($dblink, $insertSql);  
       echo "success";
   }
}

?>
</br>
</br>
</br>
<form action="mobile_register.php" method="get">
program_type:<input type="text" name="get_type" value="register"></br>

telephonenumber : <input type="text" name="telephonenumber" value="1111"></br>
password : <input type="text" name="password" value="1111"></br>
username  : <input type="text" name="username" value="1111"></br>
idcardnunber  : <input type="text" name="idcardnunber" value="1111"></br>
policVerify : <input type="text" name="policVerify" value="1111"></br>
<input type="submit" name="post" value="test"></br>
</form>