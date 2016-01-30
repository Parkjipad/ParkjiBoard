<?session_start();?>

<html>
<head>
    <meta charset="utf-8">
    <title> hihi</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<style type="text/css">
table{
    font-size: 20px;
}

div {
    position: relative;
    -webkit-animation-name: example; /* Chrome, Safari, Opera */
    -webkit-animation-duration: 2.5s; /* Chrome, Safari, Opera */
    -webkit-animation-iteration-count: 1; /* Chrome, Safari, Opera */
    -webkit-animation-direction: reverse; /* Chrome, Safari, Opera */
    animation-name: example;
    animation-duration: 2.5s;
    animation-iteration-count: 1;
    animation-direction: reverse; 
}

/* Chrome, Safari, Opera */
@-webkit-keyframes example {
    0%   {opacity: 1; }
    100% {opacity: 0; }
}

/* Standard syntax */
@keyframes example {
    0%   {opacity: 1; }
    100% {opacity: 0; }
}
.jumbotron {
    margin: 60px 0;
    text-align: center;
}
.jumbotron h1 {
    font-size: 72px;
    line-height: 1;
}
body {
    padding-top: 20px;
    padding-bottom: 40px;
}
.container-narrow {
    margin: 0 auto;
    max-width: 1200px;
}
.container-narrow > hr {
    margin: 30px 0;
}
</style>

<body>
    <div class="container-narrow" >
        <div class="jumbotron">
            <h1>Welcome</h1>
        </div>

        <hr>

        
        <div class="masthead">
            <ul class="nav nav-pills pull-right">
                <li id="a"class="active"><a href="board.php">Home</a></li>
                <li id="b"><a href="write.php">Write</a></li>
                <li id="c"><?
                if($_SESSION[user]!=NULL){
                    ?><a href="logout.php">Logout</a></li></ul>
                    <h3 class="muted"><?echo $_SESSION[user]?></h3><?
                }
                else{
                    ?><a href="login.php">Login</a></li></ul>
                    <h3 class="muted">Parkjipad</h3><?
                }
                ?>
        </div>
                    
            <?
            $_SESSION['url']=$_SERVER["REQUEST_URI"];

            $connect = mysql_connect(localhost,'root','1234')or ide("MySQL Server 연결에 실패했습니다.");
            mysql_select_db("board",$connect);

            $columns= mysql_query("show columns from board_01");

            ?>
            <div class="row">
                <table class="table table-striped span10">  
                    <tr>
                        <th align="center" class="span1">일시</th>
                        <th align="center" class="span6">제목</th>        
                        <th align="center" class="span1">글쓴이</th>
                        <th align="center" class="span2">조회수</th>
                    </tr>
                    <?

                    $row = mysql_query("SELECT * FROM board_01 ORDER BY headNt DESC");
                    while($result = mysql_fetch_array($row)){
                        $dt=$result[dt];

                        ?>
                        <tr>
                            <td align="center"><?=$result[dt]?></a></td>
                            <td align="center"><a href="content.php?headNt=<?=$result[headNt]?>"><?=$result[title]?></a></td>
                            <td align="center"><?=$result[name]?></a></td>
                            <td align="center"><?=$result[look]?></a></td>
                        </tr>
                        <?  ;}  ?>
                    </table>

                    <form action = "write.php">
                        <input type="submit" value="게시물 작성" class="btn btn-primary" style="float:right">
                    </form>
                </div>
                <script src="http://code.jquery.com/jquery-latest.min.js"></script>
                <script>
                $(document).bind('ready',function(){
                    $('li').bind('mouseover',function(e){
                        $('li').removeClass('active');
                        $(this).addClass('active');
                    })
                })
                </script>
            </body>
            </html>