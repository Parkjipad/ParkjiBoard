<?session_start();?>

<html>
<head>
    <meta charset="utf-8">
    <title> hihi</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/parkji-style.css" rel="stylesheet">
</head>
<style type="text/css">
table{
    font-size: 20px;
}

.jumbotron h1 {
    cursor: pointer;
}
body {
    padding-top: 20px;
    padding-bottom: 40px;
}
.container-narrow {
    max-width: 1000px;
}
.table td, .table th{
    text-align: center;
    vertical-align: center;
}
.btn{
    float:right;
}
</style>

<body>
    <div class="container-narrow" >
        <div class="jumbotron">
            <h1>Welcome</h1>
        </div>

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

            <?
            $_SESSION['url']=$_SERVER["REQUEST_URI"];

            $connect = mysql_connect(localhost,'root','1234')or ide("MySQL Server 연결에 실패했습니다.");
            mysql_select_db("board",$connect);

            $columns= mysql_query("show columns from board_01");



            ?>
            <div class="row">
                <div class="control-group" style="height:133px" id="divTable">
                    <table class="table table-striped span9" id="mainTable">  
                        <tr id="trTitle">
                            <th align="center" class="span1">일시</th>
                            <th align="center" class="span5">제목</th>        
                            <th align="center" class="span1">글쓴이</th>
                            <th align="center" class="span1">조회수</th>
                        </tr>
                        <?
                        if($_GET['page']==NULL) $_GET['page']=0;
                        $querypage=mysql_query("SELECT headNt FROM board_01 ORDER BY headNt DESC");
                        $tmpWriting=mysql_fetch_array($querypage);
                        $totalWriting=$tmpWriting[0];
                        $maxRange=$totalWriting-($_GET['page']*10);
                        $minRange=$totalWriting-(($_GET['page']+1)*10);
                        if($minRange<0)
                            $minRange=-1;
                        $pageCount=floor($totalWriting/10)+1;
                        $row = mysql_query("SELECT * FROM board_01 WHERE headNt>=$minRange and headNt<=$maxRange ORDER BY headNt DESC");
                        while($result = mysql_fetch_array($row)){
                            $dt=$result[dt];
                            ?>
                            <tr>
                                <td align="center"><?=$result[dt]?></td>
                                <td align="center"><a href="content.php?headNt=<?=$result[headNt]?>"><?=$result[title]?></a></td>
                                <td align="center"><?=$result[name]?></td>
                                <td align="center"><?=$result[look]?></td>
                            </tr>
                            <?  ;}  ?>
                        </table>
                    </div>
                    <div class="control-group">
                        <div class="pagination control">
                            <ul id="mainpage" style="margin-left:490">

                                <?
                                for($i=0;$i<$pageCount;$i++){?>
                                <li><a href="main.php?page=<?=$i?>"><?=$i+1?></a></li>
                                <?}?>
                            </ul>
                        </div>
                    </div>
                    <?
                    if($_SESSION['user']['Manager']==1){?>
                    <button type="button" class="btn" onClick="Edit()">편집</button>
                    <?}?>
                    
                    <button type="button" class="btn btn-primary" onClick="writepage();">게시물 작성</button>
                </div>

                <script src="http://code.jquery.com/jquery-latest.min.js"></script>
                <script>
                var hi=document.getElementById('mainTable').offsetHeight;
                var subwidth=<?=$pageCount-1?>*15;
                var ulwidth=$('#mainpage').css('margin-left');
                var a2=$('#mainTable > tbody>tr:not(#trTitle)');
                ulwidth=ulwidth.split('px')[0]-subwidth;
                $('#mainpage').css('margin-left',ulwidth);

                $('#divTable').css('height',hi);

                function writepage(){
                    window.open("write.php","_self");
                }
                function Edit(){
                    $('#mainTable > tbody>tr:first').prepend("<th class='span1'><input type='checkbox' id='allCheck' onClick='aaaa()'/></th>");
                    $('#mainTable > tbody>tr:not(#trTitle)').prepend("<td><input type='checkbox' id='a3'name='a3'/></td>");
                }
                function aaaa(){
                    var tmpCheck=$('#allCheck').is(':checked');
                    if(tmpCheck==true){
                        alert('true');
                        $('input[name="a3"]:checkbox').attr('checked',true);
                    }
                    else if(tmpCheck==false){
                        alert('false');
                      $('input[name="a3"]:checkbox').attr('checked',false);
                  }
                }

              $(document).bind('ready',function(){
                $('li').bind('mouseover',function(){
                    tmp=$(this).parent();
                    if(tmp.attr('id')=='masthead'){
                        $('li').removeClass('active');
                        $(this).addClass('active');
                    }
                });

                $('h1').bind('click',function(){
                    window.open('main.php','_self');
                });
            });

           
              </script>
          </body>
          </html>