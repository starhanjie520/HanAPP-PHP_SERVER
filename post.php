<?
include_once 'db.php';

$program_type = $_POST['program_type'];
$userid = $_POST['userid'];
$current_num = $_POST['current_num'];

if($program_type!=''){
	
	$userstate = false;
    $sql = mysql_query("SELECT * FROM $program_type")or die("datebse error!!!!");
    while($row = mysql_fetch_array($sql))
    {
	   if($userid==$row[userid]){
		 $userstate =true;
		 break;
	   }else{
		 $userstate = false;
	}
 }
 
if($userstate){
	 // echo "user success";
	 // echo "</br>";
	 
	 $sql="UPDATE $program_type SET current_num = '$current_num' , lastuse_time=now() , use_count=use_count+1 WHERE userid = '$userid'";
	 $sqlu = mysql_query($sql)or die("update error!!");
	 
	 $sqls = mysql_query("SELECT * FROM $program_type WHERE userid = '$userid'");
    while($row = mysql_fetch_array($sqls))
     {
	  $dedline = $row[deadline];
	  $program_dedline=strtotime ($dedline);
	  $curren_time=strtotime (date("Y-m-d"));
	  // echo "datebase time :".$program_dedline;
	  // echo "</br>";
	  // echo "program time :".$curren_time;
	  // echo "</br>";
	  if($curren_time>$program_dedline){
		   echo "|outoftime|".$dedline."|";
	  }else{
		   echo "|success|".$dedline."|";
	  } 
	 }
	 
}else{
	echo "|outofuse|";
}


}

//outofuse
//|outoftime|endtime|
//|success|endtime|
?>
</br>
</br>
</br>
<form action="post.php" method="post" name="post">
program_type:<input type="text" name="program_type" value="twitter"></br>
userid;<input type="text" name="userid" value="test2"></br>
current_num;<input type="text" name="current_num" value="555"></br>
<input type="submit" name="post" value="test"></br>
</form>
