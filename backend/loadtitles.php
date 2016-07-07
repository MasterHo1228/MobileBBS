<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/5/30
 * Time: 20:49
 */
header("Content-type: text/xml");
require_once("dbconn.php");

$queryFind = mysqli_query($link, "SELECT tID,tTitle,tContent,tCreatedDate,tCreatedTime,uName,tClickCount FROM viewTopics ORDER BY tID DESC LIMIT 30;");

echo "<?xml version='1.0' encoding='UTF-8'?>";
echo "<Topics>";
while ($rs = mysqli_fetch_array($queryFind)) {
    $tID = $rs['tID'];
    $tTitle = $rs['tTitle'];
    $tContent = $rs['tContent'];
    $tCreatedDate = $rs['tCreatedDate'];
    $tCreatedTime = $rs['tCreatedTime'];
    $uName = $rs['uName'];
    $tClickCount = $rs['tClickCount'];
    echo "<topic>";
    echo "<tID>" . $rs['tID'] . "</tID>";
    echo "<tLink>" . "topic.html?tID=" . $tID . "</tLink>";
    echo "<tTitle>" . $tTitle . "</tTitle>";
    echo "<tContent>" . $tContent . "</tContent>";
    echo "<tCreatedDate>" . $tCreatedDate . "</tCreatedDate>";
    echo "<tCreatedTime>" . $tCreatedTime . "</tCreatedTime>";
    echo "<Author>" . $rs['uName'] . "</Author>";
    echo "<tClickCount>" . $tClickCount . "</tClickCount>";
    echo "</topic>";
}
echo "</Topics>";
mysqli_close($link);
?>

