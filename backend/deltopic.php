<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/1
 * Time: 23:21
 */
session_start();
header("Content-type: text/html; charset=utf-8");
if (!empty($_POST['tID']) && !empty($_SESSION['uID'])) {
    $tID = $_POST['tID'];
    $uID = $_SESSION['uID'];
    require_once("dbconn.php");
    mysqli_query($link, "DELETE FROM forumtopic WHERE tID=$tID AND tCreatedByUID=$uID ;");
    if (empty(mysqli_error($link))){
        echo "<script>alert('删除话题成功！');history.go(-1);</script>";
    }else{
        echo mysqli_error($link);
    }
    mysqli_close($link);
} else {
    echo "<script>alert('非法操作！！');history.go(-1);</script>";
}

?>