<?
include_once 'common.php';
include_once 'db.php';

$posttye = $_POST['posttye'];
$program_type = $_POST['program_type'];
$program_refer = $_REQUEST['program_type'];
if($program_type == ''){
	$initpro = mysqli_query($dblink, "SELECT * FROM setting");
	$row = mysqli_fetch_array($initpro);
	$program_type=$row[program];
	// if($program_refer != ''){
	// $program_type=$program_refer;
	// }
}

//========사용자 추가=============
if($posttye =="adduser"){
	$userid = $_POST['userid'];
    $deadline = $_POST['deadline'];
    $program_type = $_POST['program_type'];
    $sql="INSERT INTO $program_type (userid,deadline)  VALUES ('$userid','$deadline')";
    $sqls = mysqli_query($dblink, $sql);
}
//========사용자 삭제=============
if($posttye =="deleteuser"){
	$userid = $_POST['userid'];
    $program_type = $_POST['program_type'];
    $sql="DELETE FROM $program_type WHERE userid='$userid'";
    $sqls = mysqli_query($dblink, $sql);
}


echo '<a href="login.php?action=logout">로그아웃</a></br></br>';  
echo '<a href="program.php">프로그램관리</a><br/>';  
?>

<title>관리자</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="./css/style.css">


<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
<script>
  $(function() {
    $( "#datepicker" ).datepicker({dateFormat: "yy-mm-dd"});
  });
</script>

<body>
<table ALIGN="center" border="2" width="35%"> 
<caption class="stitle">사용자추가</caption> 
<form name='adduser' action='index.php' method="post" ">    
	<tr bgcolor='#BEBEBE' height="60px">
	    <td ALIGN="center" width="10%">
		<select name='program_type' size='1' style="width:100px;height:25px;">			
		<?
		 $sqlset = mysqli_query($dblink, "SELECT * FROM setting");
         while($row = mysqli_fetch_array($sqlset))
        {
            echo "<option value='$row[program]'>$row[program]</option>";
        }
		?>
		</select>
		</td>
		<input type='hidden' name='posttye' value='adduser'>
		<td  width="10%"><p>아이디： <input  name='userid' id='userid'></p></td>
		<td  width="5%"><p>종료일：<input type="text" name='deadline' id="datepicker"></p></td>
		<td  width="20%"><input type='submit' name='addbutton' value='추가' style="width:60px;height:40px;" "></td>
	</tr>
</form>
</table>
	</br>
	</br>
	</br>
<table border="1" width="100%">  	
<?
$sql = mysqli_query($dblink, "SELECT * FROM setting");
while($row = mysqli_fetch_array($sql))
 {
	 echo "<form name='program_type' action='index.php' method='post'>";
	 echo "<input type='hidden' name='program_type' value='$row[program]'>"; 
	 echo "<td bgcolor='#4F4F4F' style='width:100px'><input  type='submit' name='$row[program]' value='$row[program]'  \"></td>";
	 echo "</form>";
 }
?>
</table>
</br>
</br>


<table ALIGN="center" border="1" width="50%">  
    <caption class="stitle"><?echo $program_type?> - 사용자</br></br></caption> 
	<tr bgcolor='#ACD6FF'>
		<td width="20%">ID</td>
		<td width="25%">마지막접속</td>
		<td width="15%">사용회수</td>
		<td width="25%">종료일</td>
		<td width="15%">삭제</td>
	</tr>
	
<?
$sql = mysqli_query($dblink, "SELECT * FROM $program_type");
while($row = mysqli_fetch_array($sql))
 {
	 echo "<form name='deleteuser' action='index.php' method='post'>";
	 echo "<input type='hidden' name='program_type' value='$program_type'>";
	 echo "<input type='hidden' name='posttye' value='deleteuser'>";
	 echo "<tr>";
	 echo "<input type='hidden' name='userid' value='$row[userid]'>";
	 echo "<th bgcolor='#FFDAC8' >$row[userid]</th>";
	 echo "<td bgcolor='#FFFFB9' >$row[lastuse_time]</td>";
	 echo "<td bgcolor='#FFDAC8' >$row[use_count]</td>";
	 echo "<td bgcolor='#FFFFB9' >$row[deadline]</td>";
	 echo "<td bgcolor='#FFDAC8' ><input type='submit' name='deletebutton' value='삭제'  \"></td>";
	 echo "<tr>";
	 echo "</form>";
 }

echo $result;
//mysql_close($dblink);
?>
</table>
</body>