<html>
<head>

	<meta charset="utf-8">
	<title>gg</title>
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

	$file_path = "upload/".$result[Id]."/".$result[fileName];
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
						<td class="center"><?=$result[contents]?></td>
					</tr>

					<tr>

					</tr>
					<?
					if($result[fileName]!=NULL){
					?>
					<tr>
						<td colspan="2"><img src="<?=$file_path?>" width="850" height="300" style="cursor:pointer" onclick="image();"></td>
					</tr>
					<?}?>

				</table>
				<div>
					<script src="http://code.jquery.com/jquery-latest.min.js"></script>
					<script type="text/javascript">
					function image(){
						window.open("<?=$file_path?>");
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