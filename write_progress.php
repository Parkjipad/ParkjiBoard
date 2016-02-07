<?session_start();?>
<html>
<body>
	<?
		$connect = mysql_connect(localhost,'root','1234')or die("MySQL Server 연결에 실패했습니다.");
		mysql_select_db("board",$connect);

		$row = mysql_query("select * from board_01");
		while($result = mysql_fetch_array($row)){
				$temp = $result[headNt]+1;
		}
		print_r($_FILES);
		echo "<BR>";

		$date_now=date(y."-".m."-".d);
		$look = 0;
		$file_path = "upload/".$_SESSION["user"]["Id"].$_FILES["file_up"]["name"];
		$Name = $_SESSION["user"]["Name"];
		$Id = $_SESSION["user"]["Id"];
		$filename=$_FILES["file_up"]["name"];
		
		if($_POST['title']!=NULL){
			mysql_query("INSERT INTO board_01(dt, Id, title, name, look, contents, headNt, fileName) 
						values( '$date_now', '$Id','$_POST[title]', '$Name', '$look', '$_POST[contents]', '$temp', '$filename')");
		}
		echo $temp;	
		
		if(move_uploaded_file($_FILES["file_up"]["tmp_name"],$file_path)){ 
			echo "<script>window.open('main.php','_self');</script>"; //if로 감싸지 않으면 $temp가 정상적인 값을 가지지 않는 오류가 있음.. 임시방편..
		}
		else
		{
			echo "<script>window.open('main.php','_self');</script>";	
		}
	?>

