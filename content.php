<?session_start();?>
<html>
<head>
	<meta charset="utf-8">
	<title>Content</title>
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/parkji-style.css" rel="stylesheet">
</head>
<style type="text/css">
	.table .center{
		vertical-align: middle;
	}
	.table td{
		padding-left:10px;
	}
	img{
		cursor:pointer; 
		max-width:800px;
		margin-left:60px;
	}
	
</style>
<body>
	<?
	$connect = mysql_connect(localhost,'root','1234')or ide("MySQL Server 연결에 실패했습니다.");
	mysql_select_db("board",$connect);
	$row = mysql_query("SELECT * FROM board_01 ORDER BY headNt ASC");
	$cursor = $_GET[headNt];
	
	while($result = mysql_fetch_array($row)){
		if($result[headNt]==$cursor)
			break;
	}

	$file_path = "upload/".$result[Id].$result[fileName];

	$count=$result[look]+1;
	mysql_query("UPDATE board_01 SET look='$count' WHERE headNt='$result[headNt]'");

	$con=str_replace("\r\n", "<br/>", $result[contents]);

	?>

	<div class="container narrow">
		<hr>
		
		<div class="masthead">
			<ul class="nav nav-pills pull-right">
				<li id="a"class="active"><a href="main.php">Home</a></li>
				<li id="b"><a href="write.php">Write</a></li>
				<li id="c"><?
					if($_SESSION[user]!=NULL){
						?><a href="logout.php">Logout</a></li></ul>
						<h3 class="muted"><a href="main.php"><?echo $_SESSION[user][Id]?></a></h3><?
					}
					else{
						?><a href="login.php">Login</a></li></ul>
						<h3 class="muted"><a href="main.php">Parkjipad</a></h3><?
					}
					?>
				</div>
				<hr>
				<table height="350" width="500" class="table table-striped">
					<tr height="30">
						<td>제목 </td>
						<td><?=$result[title]?></td>
					</tr>

					<tr height="30">
						<td>작성자</td>
						<td><?=$result[name]?></td>
					</tr>

					<tr lowspan="2" height="100">
						<td width="30%" class="center">본문</td>
						<td class="center"><?=$con?></td>
					</tr>

					<tr>

					</tr>
					<?
					if($result[fileName]!=NULL){
						$img = iconv("EUC-KR","UTF-8", $file_path);
						?>
						<tr>
							<td colspan="2"><img src="<?=$img?>" onclick="image();" align="middle"></td>
						</tr>
						<?}?>
					</table>

					<?
					if($_SESSION['user']['Manager']==1||$_SESSION['user']['Manager']==2||$_SESSION['user']['Id']==$result[Id]){?>
					<form method="POST" action="contentDel.php">
						<input type="hidden" name="delContent0" value="<?=$result[headNt]?>"/>
						<input type="submit" class="btn btn-danger" value="삭제" style="float:right"/>
					</form>
					
					<form method="POST" action="retouch.php">
						<input type="hidden" value="<?=$result[headNt]?>" name="index"/>
						<input type="submit" value= "수정" class="btn" style="float:right"/>
					</form>
					<?}?>
					<div>
						<script src="http://code.jquery.com/jquery-latest.min.js"></script>
						<script type="text/javascript">
							var temp=<?=$result[headNt];?>;
							document.getElementsByName('delContent0').value=temp;
							function image(){
								window.open("<?=$img?>");
							}

							$(document).bind('ready',function(){
								$('li').bind('mouseover',function(){
									$('li').removeClass('active');
									$(this).addClass('active');
								})
							})
						</script>
					</body>
					</html>