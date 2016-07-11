<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/2
 * Time: 0:32
 */
session_start();
header("Content-type: text/xml");
if (!empty($_SESSION['uID'])) {
    $uID = $_SESSION['uID'];
    require_once("dbconn.php");
    $queryFind = mysqli_query($link, "SELECT tID,tTitle,tContent,tCreatedDate,tCreatedTime FROM viewTopics WHERE tCreatedByUID=$uID ORDER BY tID DESC;");

    echo "<?xml version='1.0' encoding='UTF-8'?>";
    echo "<Topics>";
    while ($rs = mysqli_fetch_array($queryFind)) {
        $tID = $rs['tID'];
        $tTitle = html_entity_decode($rs['tTitle']);
        $tContent = html_entity_decode($rs['tContent']);
        $tCreatedDate = $rs['tCreatedDate'];
        $tCreatedTime = $rs['tCreatedTime'];

        echo "<topic>";
        echo "<tID>" . $rs['tID'] . "</tID>";
        echo "<tLink>" . "topic.html?tID=" . $tID . "</tLink>";
        echo "<tTitle>" . $tTitle . "</tTitle>";
        echo "<tContent>" . $tContent . "</tContent>";
        echo "<tCreatedDate>" . $tCreatedDate . "</tCreatedDate>";
        echo "<tCreatedTime>" . $tCreatedTime . "</tCreatedTime>";
        echo "</topic>";
    }
    echo "</Topics>";
}
?>

