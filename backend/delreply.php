<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/1
 * Time: 22:41
 */
session_start();
header("Content-type: text/html; charset=utf-8");
if (!empty($_GET['cID']) && !empty($_SESSION['uID']) && $_GET['isreplyauthor'] == true) {
    $uID = $_SESSION['uID'];
    $cID = $_GET['cID'];
    require_once("dbconn.php");
    mysqli_query($link, "DELETE FROM forumreply WHERE cID=$cID AND cSendUID=$uID");
    echo "<script>alert('删除评论成功！');history.go(-1);</script>";

    mysqli_close($link);
} else {
    echo "<script>alert('非法操作！！');history.go(-1);</script>";
}
?>