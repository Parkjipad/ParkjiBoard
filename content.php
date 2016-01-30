<html>
<head>

	<meta charset="utf-8">
	<title>gg</title>
</head>
<style type="text/css">

	table {
			border:1px solid gray;
            border-collapse: collapse;
			font-family: "돋움";

			width: 400px;
    		height: 200px;

    		animation-name: example;
    		animation-duration: 3s;
    		animation-iteration-count: 1;
    		animation-direction: reverse; 
    		
		}
		@keyframes example {
 		        0%   {color:black; border:1;}
    			/*25%  {color:red;}
    			50%  {color:blue;}
    			75%  {color:gray;}*/
    			100% {color:white;border:0;}
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

	<table border="1" height="350" width="500">
		<tr height="30">
			<td  align="center">제목 </td>
			<td colspan="6" align="center"><?=$result[title]?></td>
		</tr>

		<tr height="30">
			<td align="center">작성자</td>
			<td colspan="6" align="center"><?=$result[name]?></td>
		</tr>

		<tr height="30">
			<td colspan="5" align="center" width= "5">내용</td>
		</tr>
		
		<tr>
			<td colspan="5" align="center" width= "10"><?=$result[contents]?></td>
		</tr>
		<tr>
			<td colspan="7"><img src="<?=$file_path?>"></td>
		</tr>
		
	</table>

	</body>
</html>