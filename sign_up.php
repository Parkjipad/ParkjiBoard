<html>
<meta charset="utf-8">
<body>
	<?
		$connect=mysql_connect(localhost,'root','1234')or ide("MYSQL연결에 실패하였습니다.");
		mysql_select_db("board",$connect);
		$mail = $_POST["mailName"]."@".$_POST["mailCompany"];
		$tel;
		settype($tel,"string");
		$tel = $_POST["firstPhoneNum"].$_POST["middlePhoneNum"].$_POST["lastPhoneNum"];
		

		echo $_POST['Name'];
		if($_POST['Name']!=NULL){
				mysql_query("INSERT INTO member(Name, Id, Password, Mail, callNum) 
							values('$_POST[Name]', '$_POST[Id]','$_POST[Pass]','$mail','$tel' )");
				echo "<script>alert('가입이 완료되었습니다.');window.open('main.php','_self');</script>";
		}	
	?>
</body>
</html>