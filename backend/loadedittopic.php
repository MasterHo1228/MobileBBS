<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/6/2
 * Time: 1:25
 */
session_start();
header("Content-type: text/xml");
echo "<?xml version='1.0' encoding='UTF-8'?>";
echo "<Topics>";
if (!empty($_SESSION['uID']) && !empty($_GET['topicID'])) {
    $tID = $_GET['topicID'];
    $uID = $_SESSION['uID'];
    require_once("dbconn.php");
    $queryFind = mysqli_query($link, "SELECT tTitle,tContent FROM forumtopic WHERE tID=$tID AND tCreatedByUID=$uID ;");

    if (mysqli_num_rows($queryFind)==1){
        while ($rs = mysqli_fetch_array($queryFind)) {
            $tTitle = $rs['tTitle'];
            $tContent = $rs['tContent'];
            echo "<topic>";
            echo "<tTitle>" . $tTitle . "</tTitle>";
            echo "<tContent>" . $tContent . "</tContent>";
            echo "</topic>";
        }
    }
    mysqli_close($link);
}
echo "</Topics>";
?>

