<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/5/30
 * Time: 21:56
 */
session_start();
header("Content-type: text/html; charset=utf-8");
if (!empty($_GET['tID'])){
    $topicID=$_GET['tID'];
    if (!empty($_SESSION['uID'])){
        $_SESSION['topicID']=$topicID;//如果客户端有登录账号的话，打开一条帖子的时候后台记录一下TopicID，如果前台要回复帖子的话就来后台调用下session的数据就行了
    }
    require_once ("backend/dbconn.php");

    mysqli_query($link,"UPDATE forumtopic SET tClickCount=tClickCount+1 WHERE tID='$topicID';");

    $queryLoad=mysqli_query($link,"SELECT tID,tTitle,tContent,uName,tCreatedDate,tCreatedTime,tCreatedByUID FROM viewtopics WHERE tID=$topicID ;");
    while ($rs=mysqli_fetch_array($queryLoad)){
        $tID=$rs['tID'];
        $tTitle=$rs['tTitle'];
        $tContent=$rs['tContent'];
        $uName=$rs['uName'];
        $tCreatedDate=$rs['tCreatedDate'];
        $tCreatedTime=$rs['tCreatedTime'];
        $topicAuthorID=$rs['tCreatedByUID'];
    ?>
<link rel="stylesheet" type="text/css" href="css/mobilebbs.css">
<div data-role="page" id="Topic">
    <div data-role="header" data-position="fixed">
        <a href="#" data-role="button" data-rel="back" data-icon="back">返回</a>
        <h1>话题内容</h1>
        <?php
            if (!empty($_SESSION['uID'])){
                echo "<a href='index.html/#User' data-role='button' data-icon='user' class='ui-btn-right' data-transition='slide'>用户</a>";
            }
            else{
                echo "<a href='index.html/#Login' data-role='button' data-icon='user' class='ui-btn-right' data-transition='slide'>登录</a>";
            }
        ?>
    </div><!-- /header -->
    <div data-role="content">
        <h3 class="ui-bar ui-bar-a ui-corner-all">标题：<?php echo $tTitle?></h3>
        <div class="ui-body ui-body-a ui-corner-all">
            <p>
                <?php echo $tContent?><br/><br/>
                <span class="topicInfo">作者：<?php echo $uName?><br/>发布时间：<?php echo $tCreatedDate."&nbsp".$tCreatedTime?></span><br/>
                <?php
                    if(@$_SESSION['uID']==$topicAuthorID){
                        echo "<a href='index.html#editTopic' class='ui-btn ui-mini ui-btn-inline'>编辑话题</a>";
                        echo "<a href='backend/deltopic.php?tID=".$tID."&isauthor=true"."' class='ui-btn ui-mini ui-btn-inline'>删除话题</a>";
                    }
                ?>
            </p>
        </div>
<?php
    }
?>
<?php
    $strQueryFindRe="SELECT DISTINCT a.cID,a.cContent,a.uName,a.cSendUID,a.cSendDate,a.cSendTime FROM viewtopicrepose a,forumtopic b WHERE a.tID='$topicID';";
    $queryRE=mysqli_query($link,$strQueryFindRe);
    if (mysqli_num_rows($queryRE)>0){
        while ($rsRE=mysqli_fetch_array($queryRE)){
            $cID=$rsRE['cID'];
            echo "<div class='ui-corner-all custom-corners'>";
                echo "<div class='ui-bar ui-bar-a'>";
            $uNameRE=$rsRE['uName'];
                    echo "<h3>来自: ".$uNameRE." 的回复</h3>";
                echo "</div>";
                echo "<div class='ui-body ui-body-a'>";
            $cContent=$rsRE['cContent'];
            $ReplyUID=$rsRE['cSendUID'];
            $cSendDate=$rsRE['cSendDate'];
            $cSendTime=$rsRE['cSendTime'];
                    echo "<p>";
                        echo $cContent."<br/>";
                        echo "<span class='topicInfo'>发送时间:".$cSendDate."&nbsp".$cSendTime."</span>";
                    if ($ReplyUID==@$_SESSION['uID']){
                        echo "<a href='backend/delreply.php?cID=".$cID."&isreplyauthor=true"."' class='ui-btn ui-mini ui-btn-inline'>删除回复</a>";
                    }
                    echo "</p>";
                echo "</div>";
            echo "</div>";
        }
    }
    mysqli_close($link);
}
else {
    echo "<script>alert('找不到帖子或帖子已被删除！');history.go(-1);</script>";
}
?>
    </div><!-- /content -->
    <div data-role="footer" data-position="fixed">
        <?php
            if (!empty($_SESSION['uID'])){
//                echo "<h1><a href='index.html#PubReply' data-role='button' data-transition='flip'>回复话题</a></h1>";
                echo "<div data-role='navbar' data-iconpos='left' id='btnFtNewReply'>
                        <ul>
                            <li><a href='index.html#PubReply' data-role='button' class='ui-btn' data-icon='plus' data-transition='flip'>发表评论</a></li>
                        </ul>
                      </div>";
            }
        ?>
        <h1 class="copyRight">Copyright&copy; MasterHo 2016<br>Powered by jQuery Mobile.</h1>
    </div>
</div><!-- /page -->

