<?session_start();?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="css/parkji-style.css" rel="stylesheet">
<style type="text/css">
	.table .center{
		vertical-align: middle;
	}
	.table td{
		padding-left:10px;
	}
	input{
		width: 430px;
		font-size: 14px;
		margin:auto;
	}
	
</style>
<body>
	<?
	$connect = mysql_connect(localhost,'root','1234')or ide("MySQL Server 연결에 실패했습니다.");
	mysql_select_db("board",$connect);
	$row = mysql_query("SELECT * FROM board_01");
	$cursor = $_POST[index];
	
	while($result = mysql_fetch_array($row)){
		if($result[headNt]==$cursor)
			break;
	}
	?>

	<div class="container narrow">
		<hr>
		
		<div class="masthead">
			<ul class="nav nav-pills pull-right">
				<li id="a"class="active"><a href="main.php">Home</a></li>
				<li id="b"><a href="write.php">Write</a></li>
				<li id="c">
					<a href="logout.php">Logout</a></li></ul>
					<h3 class="muted"><a href="main.php"><?echo $_SESSION[user][Id]?></a></h3>
				</div>
				<hr>

				<form method="POST" action="retouch_progress.php" enctype="multipart/form-data">
				<table height="350" width="500" class="table table-striped">
					<tr height="30">
						<td>제목 </td>
						<td><input type="text" name="title" value="<?=$result['title']?>" onkeydown="return captureReturnKey(event)"/></td>
					</tr>
					<tr lowspan="2" height="100">
						<td width="30%" class="center">본문</td>
						<td><textarea style="height:220px" name="contents" value="<?=$result['contents']?>"/></textarea></td>
					</tr>
					</table>
					<div class="control">
					<hr><input type="file" name="file_up"/><br><br><hr>
					<input type="hidden" value=<?=$result[headNt]?> name="index"/>
					<input type="submit" class="btn btn-primary" value="완료"/>
					</div>
				</div>

				<script type="text/javascript">
				function captureReturnKey(e) { 
					if(e.keyCode==13){ 
						e.value+="<br>";
						return false; 
					}
				} 
			</script>
			</body>
			</html>