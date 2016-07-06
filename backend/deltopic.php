<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/1
 * Time: 23:21
 */
session_start();
header("Content-type: text/html; charset=utf-8");
if (!empty($_GET['tID']) && !empty($_SESSION['topicID']) && !empty($_SESSION['uID']) && $_GET['isauthor'] == true) {
    $GtID = $_GET['tID'];
    $StID = $_SESSION['topicID'];
    if ($GtID == $StID) {
        $uID = $_SESSION['uID'];
        require_once("dbconn.php");
        mysqli_query($link, "DELETE FROM forumtopic WHERE tID=$GtID AND tCreatedByUID=$uID");
        echo "<script>alert('删除话题成功！');history.go(-1);</script>";

        mysqli_close($link);
    }
} else {
    echo "<script>alert('非法操作！！');history.go(-1);</script>";
}

?>