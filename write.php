<?session_start()?>
<html>
<head>
	<meta charset="utf-8">
	<title>Insert Page</title>
</head>
<body>
	<?
		if(!isset($_SESSION["user"])) {
			$_SESSION['url']=$_SERVER["REQUEST_URI"];
			echo "<script>alert('게시글 작성은 회원만 가능합니다.');</script>";
			echo "<meta http-equiv='refresh' content='0;url=login.php'>";
			exit;
		}
	?>
	
	<form name = "write_content" method="POST" enctype="multipart/form-data" action="write_progress.php">
		제목 : <input type="text" name="title" size="30"></input><br>
		내용 : <input type="text" name="contents" height="100px"></input><br>
		파일 : <input type="file" name="file_up" size="12"></input><br>
		<input type="submit"  value="입력"/></input>
	</form>
		
</body>
</html>

	
