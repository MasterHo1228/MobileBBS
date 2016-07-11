<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/1
 * Time: 19:57
 */
session_start();
header("Content-type: text/xml");
if (!empty($_GET['topicID']) && !empty($_SESSION['uID'])) {
    $tID = $_GET['topicID'];
    require_once("dbconn.php");

    $queryFind = mysqli_query($link, "SELECT tTitle FROM forumtopic WHERE tID=$tID;");
    echo "<?xml version='1.0' encoding='UTF-8'?>";
    while ($rs = mysqli_fetch_array($queryFind)) {
        $tTitle = html_entity_decode($rs[0]);
        echo "<Title>".$tTitle."</Title>";
    }
    mysqli_close($link);
}
?>