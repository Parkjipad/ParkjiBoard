<html>
<meta charset="utf-8">
<body>

	<?
	$i=0;
	$del=array();
	while($_POST['delContent'.$i]){
		$del[]=$_POST['delContent'.$i];
		echo $_POST['delContent0']."<br>";
		$i++;
	}

	print_r($del);

	$connect = mysql_connect(localhost,'root','1234')or ide("MySQL Server 연결에 실패했습니다.");
	mysql_select_db("board",$connect);

	for($i=0;$i<count($del);$i++){
		mysql_query("DELETE FROM board_01 where headNt=$del[$i]");
	}
	echo "<br>";
	$i--;
	$j=0;
	$minRange=$del[$i]; //12
	$maxRange=$del[0]+1; //14
	$delquery=mysql_query("SELECT headNt FROM board_01 WHERE headNt>=$minRange ORDER BY headNt DESC");
	while($result=mysql_fetch_array($delquery)){
		mysql_query("UPDATE board_01 SET headNt='$minRange' WHERE headNt='$maxRange'");
		$minRange++;
		$maxRange++;
	}
	//echo "<script>alert('삭제가 완료되었습니다.');history.back();</script>";
	?>

</body>
</html>