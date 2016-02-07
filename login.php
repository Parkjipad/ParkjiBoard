<html>
<meta charset="utf-8">
<head>
	<title>로그인!!!!!</title>
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/parkji-style.css" rel="stylesheet">
</head>
<body>
	<div class="container narrow">
		<hr>

		<div class="masthead">
			<ul class="nav nav-pills pull-right" id="masthead">
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

			<div class="row" style="margin-left:50px">
				<form method = "POST" action="login_progress.php" class="form-horizontal">
					<div class="control-group">
						<label class="control-label" for="login_id"><h3 class="span2">아이디 : </h3></label>
						<div class="control span6">
							<input type = "text" id="signText" name = "login_id"></input>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="login_pw"><h3 class="span2">비밀번호 : </h3></label>
						<div class="control span6">
							<input type = "password" id="signText" name = "login_pw"></input>
						</div>
					</div>
					<div style="margin-left:250px">
						<input type = "submit" class="btn btn-primary"value="로그인"></input> 
						<input type = "button" class="btn" value = "회원가입" onClick = "pagemove()"></input>
					</div>
			</form>
			</div>

			<script src="http://code.jquery.com/jquery-latest.min.js"></script>
			<script>
			function pagemove(){
				window.open("sign.html","_self");
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