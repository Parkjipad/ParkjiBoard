<?session_start();?>
<html>
<meta charset = "utf-8">
<body>
	<?
		$connect = mysql_connect(localhost,'root','1234')or ide("MySQL Server 연결에 실패했습니다.");
		mysql_select_db("board",$connect);

		$login_ok = 0;
		$row = mysql_query("SELECT * FROM member ORDER BY Name ASC");

		while($result = mysql_fetch_array($row)){
			if($_POST["login_id"]==$result[Id]){
				if($_POST["login_pw"] == $result[Password]){
					$login_array= array("Id"=>"$result[Id]","Name"=>"$result[Name]","Manager"=>"$result[manager]");
					$_SESSION["user"] = $login_array;
					echo "<script>alert('$result[Name]님 환영합니다.');window.open('$_SESSION[url]','_self');</script>";		
					$login_ok = 1;		
					break;			
				}

				else{ 
					echo "<script>alert('비밀번호가 틀립니다.');history.back();</script>";
				}	
			}
		}

		if($login_ok==0){
			echo "<script>alert('일치하는 아이디가 없습니다.');history.back();</script>";
		}
	?>
</body>
</html>