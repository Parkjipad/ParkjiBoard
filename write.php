<?session_start()?>
<html>
<head>
	<meta charset="utf-8">
	<title>Insert Page</title>
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/parkji-style.css" rel="stylesheet">
</head>
<style>
	#contentText{
		width: 430px;
		height: 200px;
		font-size: 14px;
		margin:auto;
	}
	.control{
		height:65px;
	}
</style>
<body>
	<?
	if(!isset($_SESSION["user"])) {
		$_SESSION['url']=$_SERVER["REQUEST_URI"];
		echo "<script>alert('게시글 작성은 회원만 가능합니다.');</script>";
		echo "<meta http-equiv='refresh' content='0;url=login.php'>";
		exit;
	}
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
				<form name = "write_content" method="POST" enctype="multipart/form-data" action="write_progress.php" class="form-horizontal" onsubmit="captureReturnKey(event)">
					<div class="control-group">
						<label class="control-label" for="title"><h3>제목 : </h3></label>
						<div class="control">
							<input type="text" name="title" size="30" id="signText"></input>
						</div>
					</div>
					<div class="control-group" style="height:220px">
						<label class="control-label" for="contents" style:"text-align: center;"><h3>내용 : </h3></label>
						<div class="control" style="margin-top:20px">
							<input type="text" name="contents" id="contentText" height="100px" onkeydown="javascript:if(event.keyCode==13){goPage('1'); return false;}"></input>
						</div>
					</div>
					<div class="control-group" >
						<label class="control-label" for="file_up"><h3>파일 : </h3></label>
						<div class="control" style="height:60px; margin:12px">
							<input type="file" name="file_up" size="12"style="height:40px"></input>
						</div>
					</div>
					<input type="submit" class="btn btn-primary" value="입력" onClick="submit()" style="margin-left:80px;"/></input>
					<input type="reset" class="btn btn-info" value="다시 적기"></form>
				</form>
			</div>
			<script src="http://code.jquery.com/jquery-latest.min.js"></script>
			<script type="text/javascript">
				function captureReturnKey(e) { 
					if(e.keyCode==13) 
						return false; 
				} 
			</script>

		</body>
		</html>


