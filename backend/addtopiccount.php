<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/7/6
 * Time: 23:44
 */
if (!empty($_GET['tID'])){
    $topicID=$_GET['tID'];
    require_once ("dbconn.php");
    mysqli_query($link,"UPDATE forumtopic SET tClickCount=tClickCount+1 WHERE tID='$topicID';");
    mysqli_close($link);
}
?>