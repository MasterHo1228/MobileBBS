<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/1
 * Time: 1:23
 */
session_start();
header("Content-type: text/html; charset=utf-8");
if (!empty($_SESSION['topicID']) && !empty($_POST['ReplyContent'])) {
    require_once("dbconn.php");
    $topicID = $_SESSION['topicID'];
    $uID = $_SESSION['uID'];
    $ReplyContent = mysqli_real_escape_string($link, $_POST['ReplyContent']);

    $querySendReply = mysqli_query($link, "INSERT INTO forumreply(tID,cSendUID,cContent) VALUES ($topicID,$uID,'$ReplyContent');");
    if ($querySendReply) {
        echo "<script>alert('发布成功!');history.go(-1);</script>";
    } else {
        echo "<script>alert('发布失败！')</script>";
    }
}
?>