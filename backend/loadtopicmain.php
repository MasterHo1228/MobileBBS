<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/7/6
 * Time: 23:29
 */
header("Content-type: text/xml");
if (!empty($_GET['tID'])){
    $topicID=$_GET['tID'];
    require_once ("dbconn.php");

    $queryLoad=mysqli_query($link,"SELECT tID,tTitle,tContent,uName,tCreatedDate,tCreatedTime,tCreatedByUID FROM viewtopics WHERE tID=$topicID ;");
    if (mysqli_num_rows($queryLoad)>0){
        echo "<?xml version='1.0' encoding='UTF-8'?>";
        echo "<Topics>";
        while ($rs=mysqli_fetch_array($queryLoad)) {
            echo "<topic>";
            $tID = $rs['tID'];
            echo "<ID>".$tID."</ID>";
            $tTitle = $rs['tTitle'];
            echo "<title>".$tTitle."</title>";
            $tContent = $rs['tContent'];
            echo "<content>".$tContent."</content>";
            $uName = $rs['uName'];
            echo "<author>".$uName."</author>";
            $tCreatedDate = $rs['tCreatedDate'];
            $tCreatedTime = $rs['tCreatedTime'];
            echo "<time>".$tCreatedDate.' '.$tCreatedTime."</time>";
            $topicAuthorID = $rs['tCreatedByUID'];
            echo "</topic>";
        }
        echo "</Topics>";
    }
    mysqli_close($link);
}
?>