<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/2
 * Time: 1:45
 */
session_start();
header("Content-type: text/html; charset=utf-8");
if (!empty($_SESSION['uID']) && !empty($_POST['topicID'])) {
    $uID = $_SESSION['uID'];
    $tID = $_POST['topicID'];

    if (!empty($_POST['edTopicTitle']) && !empty($_POST['edTopicContent'])){
        require_once("dbconn.php");
        $tTitle = htmlentities((mysqli_real_escape_string($link, $_POST['edTopicTitle'])),ENT_QUOTES,'UTF-8');
        $tContent = htmlentities((mysqli_real_escape_string($link, $_POST['edTopicContent'])),ENT_QUOTES,'UTF-8');

        $queryUP = mysqli_query($link, "UPDATE forumtopic SET tTitle='$tTitle',tContent='$tContent' WHERE tID=$tID AND tCreatedByUID=$uID;");
        if (empty(mysqli_error($link))) {
            echo "<script>alert('话题编辑成功!');history.go(-1);</script>";
        } else {
            echo "<script>alert('提交失败！')</script>";
        }
        mysqli_close($link);
    } else {
        echo "<script>alert('请输入话题标题或内容！')</script>";
    }
}
?>