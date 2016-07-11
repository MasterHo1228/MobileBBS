<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/5/31
 * Time: 22:42
 */
session_start();
if (!empty($_POST['nTopicTitle']) && !empty($_POST['nTopicContent'])) {
    require_once("dbconn.php");
    $uID = $_SESSION['uID'];

    $tTitle = htmlentities((mysqli_real_escape_string($link, $_POST['nTopicTitle'])),ENT_QUOTES,'UTF-8');
    $tContent = htmlentities((mysqli_real_escape_string($link, $_POST['nTopicContent'])),ENT_QUOTES,'UTF-8');

    $queryPub = mysqli_query($link, "INSERT INTO forumtopic(tTitle,tContent,tCreatedByUID) VALUES ('$tTitle','$tContent',$uID);");
    if ($queryPub) {
        echo "<script>alert('发布成功!');history.go(-1);location.reload();</script>";
    } else {
        echo "<script>alert('发布失败！')</script>";
    }
    mysqli_close($link);
}
?>