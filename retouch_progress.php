<?
$connect = mysql_connect(localhost,'root','1234')or die("MySQL Server 연결에 실패했습니다.");
mysql_select_db("board",$connect);
$row=mysql_query("SELECT * FROM board_01 ORDER BY headNt DESC");
$result=mysql_fetch_array($row);
$fileName=$_FILES['file_up']['name'];
$file_path = "upload/".$result[Id].$_FILES["file_up"]["name"];
print_r($fileName);
if(move_uploaded_file($_FILES["file_up"]["tmp_name"],$file_path)){ 
	mysql_query("UPDATE board_01 SET fileName='$fileName' WHERE headNt='$_POST[index]'");
}

mysql_query("UPDATE board_01 SET contents='$_POST[contents]', title='$_POST[title]' WHERE headNt='$_POST[index]'");
echo "<script>history.go(-2);</script>";
?>