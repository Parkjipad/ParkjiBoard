<html>
<meta charset="utf-8">
<body>
    <script  src="http://code.jquery.com/jquery-latest.min.js"></script>

	<form method ="POST" action = "id_Check.php" name = "check_frm" id ="frm">
		아이디 : <input type = "text" name = "id_temp" id="id_check"/>
        <input type="submit" value ="검사하기"/>
		<input type = "button" id = "button" value = "적용하기" onClick = "clickbt();"/>
	</form>

	<?
		$connect = mysql_connect(localhost,'root','1234')or ide("MySQL Server 연결에 실패했습니다.");
        mysql_select_db("board",$connect);

        $id_ok=2;//중복 검사 결과를 저장해주는 변수
        $count=0;//데이터베이스 안에 있는 개체의 수를 저장하는 변수

        $row = mysql_query("SELECT * FROM member");
        while($result = mysql_fetch_array($row)){
            $temp[$count] = $result[Id];//각 객체의 Id를 배열로 저장
            $count++;
        }

        for($i=0;$i<$count;$i++){
            if($temp[$i]==$_POST["id_temp"]){//같은 Id가 있을 때
                $id_ok=1;
                break;
            }
            else if($_POST['id_temp']!=NULL){   //같은 Id가 없을 때
                $id_ok=0;
            }
        }
        echo $_POST["id_temp"]."<br>";

    ?>
    <form name = "hidden">
        <input type = "hidden" id = "temp_form" value = <?=$id_ok?>></input><!--php의 변수를 Javascript로 전달하기 위한 input-->
        <input type = "hidden" id = "temp_return" value = <?=$_POST["id_temp"]?>></input><!--id_Check.php에서 검사한 Id를 Sign.php로 전달하기 위한 input-->
    </form>
    <script type="text/javascript">
        var temp_id = $("#temp_form").attr("value");
        
        if(temp_id==0){
            $("#frm").append("<br><b color= 'blue'>사용가능한 아이디입니다.</b>");
            $("b").css("color","blue");
        }
        else if(temp_id==1){
            $("#frm").append("<br><b color='red'>이미 사용중인 아이디입니다.</b>");
            $("b").css("color","red");
        }

        if(temp_id!=0){
            $("#button").attr("type","hidden");                
        }

        function clickbt(){
            opener.parent.insertId();
            window.close();
        }
    </script>

</body>
</html>