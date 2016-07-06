<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/1
 * Time: 19:57
 */
session_start();
header("Content-type: text/html; charset=utf-8");
if (!empty($_SESSION['topicID']) && !empty($_SESSION['uID'])) {
    $tID = $_SESSION['topicID'];
    require_once("dbconn.php");

    $queryFind = mysqli_query($link, "SELECT tTitle FROM forumtopic WHERE tID=$tID;");
    while ($rs = mysqli_fetch_array($queryFind)) {
        $tTitle = $rs[0];
    }
    echo $tTitle;
    mysqli_close($link);
}
?>