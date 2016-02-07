<?session_start();?>
<html>
<head>
    <title>ParkjiBoard</title>
    <meta charset="utf-8">
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
        margin-left: 40px;
    }
</style>

<body>
    <?
    $connect = mysql_connect(localhost,'root','1234')or ide("MySQL Server 연결에 실패했습니다.");
    mysql_select_db("board",$connect);

    if($_GET['page']==NULL) $_GET['page']=0;
    $querypage=mysql_query("SELECT headNt FROM board_01 ORDER BY headNt DESC");     //마지막 게시글 넘버를 확인하기 위한 쿼리
    $tmpWriting=mysql_fetch_array($querypage);                                      
    $totalWriting=$tmpWriting[0];                                                   
    $maxRange=$totalWriting-($_GET['page']*10);                                     //한 페이지에 10개의 게시물이 등록이 되게끔 DB의 범위를 지정
    $minRange=$totalWriting-(($_GET['page']+1)*10);
    if($minRange<0)
        $minRange=-1;
    $pageCount=floor($totalWriting/10)+1;
    $row = mysql_query("SELECT * FROM board_01 WHERE headNt>$minRange and headNt<=$maxRange ORDER BY headNt DESC");
    ?>
    <meta charset='utf-8' />
    <div class="container-narrow">
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

                <div class="row">
                    <div class="control-group" style="height:133px" id="divTable">
                        <table class="table table-striped span10" id="mainTable">  
                            <tr id="trTitle">
                                <th align="center" class="span1">일시</th>
                                <th align="center" class="span5">제목</th>        
                                <th align="center" class="span1">글쓴이</th>
                                <th align="center" class="span1">조회수</th>
                            </tr>
                            <?
                            $head=array();      //게시글 번호를 저장할 배열.
                            while($result = mysql_fetch_array($row)){ //테이블 내용을 채워줌.
                                $dt=$result[dt];
                                $head[]=$result[headNt];
                                ?>
                                <tr>
                                    <td align="center"><?=$result[dt]?></td>
                                    <td align="center"><a href="content.php?headNt=<?=$result[headNt]?>"><?=$result[title]?></a></td>
                                    <td align="center"><?=$result[name]?></td>
                                    <td align="center"><?=$result[look]?></td>
                                </tr>
                                <?  }  ?>
                            </table>
                        </div>
                        <div class="control-group">            <!--페이지 탐색막대 게시물 10개마다 1개씩 추가된다.-->
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
                        if($_SESSION['user']['Manager']==2){?>
                        <button type="button" class="btn btn-danger" onClick="Del()">삭제</button>
                        <button type="button" class="btn" onClick="Edit()">편집</button>
                        <?}?>
                        <button type="button" class="btn btn-primary" onClick="writepage();">게시물 작성</button>
                    </div>
                </div>
                <form method="POST" name="delFrm" id="delFrm" action="contentDel.php">
                </form>
                <?
                    $json=json_encode($head);//게시글 번호 배열을 스크립트에 넘기기 위해 json을 사용
                ?>


                <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
                <script type="text/javascript">
                    var rowCount = $('#mainTable tr').length;     //테이블의 행 갯수 얻는 변수
                    var editCount=0; //체크박스 생성 유무를 확인하는 변수

                    var subwidth=<?=$pageCount-1?>*15;                      //페이지 탐색 넘버가 추가 될 때 
                    var ulwidth=$('#mainpage').css('margin-left');          //margin을 맞춰 제목과 탐색막대가 일치하게 함.
                    ulwidth=ulwidth.split('px')[0]-subwidth;
                    $('#mainpage').css('margin-left',ulwidth);

                    var delArray=new Array();                               //바로 밑에 있는 JSON배열을 받아서 
                    var headNt=<?=$json;?>;                                 //Checkbox에 value값을 뿌려줌.
                    
                    var realTable=document.getElementById('mainTable').offsetHeight;//실제 테이블 크기와 div의 크기를 맞춤
                    $('#divTable').css('height',realTable);

                    function writepage(){
                        window.open("write.php","_self");
                    }

                    function Edit(){
                        if(editCount==0){
                            $('#mainTable > tbody>tr:first').prepend("<th class='span1'><input type='checkbox' id='allCheck' onClick='checkAll()'/></th>");
                            $('#mainTable > tbody>tr:not(#trTitle)').prepend("<td><input type='checkbox' name='delCheck'/></td>");
                            editCount=1;
                            delArray=document.getElementsByName('delCheck');
                            for(i=0;i<rowCount;i++){
                                delArray[i].value=headNt[i];
                            }
                        }

                        else if(editCount==1){
                            i=0;
                            for(i=0;i<rowCount;i++){
                                tdCheckbox=document.getElementById('mainTable').children[0].children[i].children[0];
                                tdCheckbox.remove();
                            } editCount=0;
                        }
                    }

                    function Del(){

                        if(editCount==1&&confirm("선택한 게시물을 삭제하시겠습니까?")){
                            var j=0;
                            for(i=0;i<rowCount-1;i++){
                                if(delArray[i].checked){
                                    $('#delFrm').append("<input type='hidden' name='delContent"+j+"' value='"+delArray[i].value+"'/>");
                                    j++;
                                }}
                                document.getElementById('delFrm').submit();
                            }
                            else if(editCount==0){
                                alert("삭제할 게시물을 선택해야 합니다.");
                            }
                        }

                        function checkAll(){
                            var tmpCheck=$('#allCheck').is(':checked');
                            if(tmpCheck==true){
                                $('input').attr('checked',true);
                            }
                            else if(tmpCheck==false){
                                $('input').attr('checked',false);
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