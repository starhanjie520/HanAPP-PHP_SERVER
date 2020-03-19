<?
include_once 'common.php';
include_once 'db.php';

echo '<a href="login.php?action=logout">로그아웃</a></br></br>';  
echo '<a href="index.php">사용자관리</a><br />';  
$posttye = $_POST['posttye'];
$program_type = $_POST['program_type'];

//========프로그램 추가=============
if($posttye =="addprogram"){
	$csetting="CREATE TABLE IF NOT EXISTS `setting` (
      `program` varchar(50) NOT NULL
    )";
	mysqli_query($dblink, $csetting);
	
	$sql="INSERT INTO setting (program)  VALUES ('$program_type')";
    mysqli_query($dblink, $sql);
	
	$ctable="CREATE TABLE IF NOT EXISTS `$program_type` (
      `userid` varchar(50) NOT NULL,
      `current_num` int(10) NOT NULL,
      `lastuse_time` datetime NOT NULL,
      `use_count` int(10) NOT NULL,
      `deadline` date NOT NULL
    )";
	mysqli_query($dblink, $ctable);
}

//========프로그램 삭제=============
if($posttye =="deleteprogram"){
	$sql="DELETE FROM setting WHERE program='$program_type'";
    mysqli_query($dblink, $sql)or die ("programlist delete error");
	$tsql="DROP TABLE `$program_type`";
	mysqli_query($dblink, $tsql)or die("dateble delete error");
}
?>

<title>프로그램관리</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="./css/style.css">

<body>
<table ALIGN="center" border="2" width="35%"> 
<caption class="stitle">프로그램추가</caption> 
<form name='program' action='program.php' method="post" ">
	<tr bgcolor='#BEBEBE' height="60px">
	    <input type='hidden' name='posttye' value='addprogram'>
		<td  width="10%"><p>프로그램 : <input  name='program_type' id='program_type'></p></td>
		<td  width="20%"><input type='submit' name='addbutton' value='추가' "></td>
	</tr>
</form>
</table>
</br>
</br>
</br>
<table ALIGN="center" border="1" width="40%">  
    <caption class="stitle">프로그램 </br></br></caption> 
	<tr bgcolor='#ACD6FF'>
		<td width="20%">프로그램</td>
		<td width="15%">삭제</td>
	</tr>
<?

$sql = mysqli_query($dblink, "SELECT * FROM setting");
while($row = mysqli_fetch_array($sql))
 {
	 echo "<form name='delete' action='program.php' method='post'>";
	 echo "<input type='hidden' name='posttye' value='deleteprogram'>";
	 echo "<input type='hidden' name='program_type' value='$row[program]'>";
	 echo "<tr>";
	 echo "<td bgcolor='#FFFFB9' >$row[program]</td>";
	 echo "<td bgcolor='#FFDAC8' ><input type='submit' name='deletebutton' value='삭제'  \"></td>";
	 echo "<tr>";
	 echo "</form>";
 }


mysqli_close($dblink);
?>
</table>
</body>