#<html>
<meta charset="utf-8">
<head>
	<title>로그인!!!!!</title>
</head>
<body>
	<form method = "POST" action="login_progress.php">
		<ul>
		<li>아이디 : <input type = "text" name = "login_id"></input></li>
		<li>비밀번호 : <input type="password" name="login_pw"></input></a></li>
		<li><input type = "submit" value="로그인"></input> <input type = "button" value = "회원가입" onClick = "pagemove()"</li>
	</form>

	<script>
		function pagemove(){
			window.open("sign.php","_self");
		}
	</script>
</body>
</html>