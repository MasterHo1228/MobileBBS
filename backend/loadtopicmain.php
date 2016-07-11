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

    $queryLoad=mysqli_query($link,"SELECT tID,tTitle,tContent,tCreatedByUID,uName,tCreatedDate,tCreatedTime,tCreatedByUID FROM viewtopics WHERE tID=$topicID ;");
    if (mysqli_num_rows($queryLoad)>0){
        echo "<?xml version='1.0' encoding='UTF-8'?>";
        echo "<Topics>";
        while ($rs=mysqli_fetch_array($queryLoad)) {
            echo "<topic>";
            $tID = $rs['tID'];
            echo "<ID>".$tID."</ID>";
            $tTitle = html_entity_decode($rs['tTitle']);
            echo "<title>".$tTitle."</title>";
            $tContent = html_entity_decode($rs['tContent']);
            echo "<content>".$tContent."</content>";
            $topicAuthorID = $rs['tCreatedByUID'];
            echo "<authorID>".$topicAuthorID."</authorID>";
            $uName = html_entity_decode($rs['uName']);
            echo "<author>".$uName."</author>";
            $tCreatedDate = $rs['tCreatedDate'];
            $tCreatedTime = $rs['tCreatedTime'];
            echo "<time>".$tCreatedDate.' '.$tCreatedTime."</time>";

            echo "<Replies>";
            $queryRE=mysqli_query($link,"SELECT DISTINCT a.cID,a.cSendUID,a.uName,a.cContent,a.cSendDate,a.cSendTime FROM viewtopicreply a,forumtopic b WHERE a.tID='$topicID';");
            if (mysqli_num_rows($queryRE)>0){
                while ($rsReply=mysqli_fetch_array($queryRE)){
                    echo "<reply>";
                        $replyID=$rsReply['cID'];
                        echo "<replyID>".$replyID."</replyID>";
                        $replyerUID=$rsReply['cSendUID'];
                        echo "<replyerUID>".$replyerUID."</replyerUID>";
                        $replyerName=html_entity_decode($rsReply['uName']);
                        echo "<replyerName>".$replyerName."</replyerName>";
                        $replyerContent=html_entity_decode($rsReply['cContent']);
                        echo "<replyContent>".$replyerContent."</replyContent>";
                        $replyDate=$rsReply['cSendDate'];
                        $replyTime=$rsReply['cSendTime'];
                        echo "<replySendTime>".$replyDate.' '.$replyTime."</replySendTime>";
                    echo "</reply>";
                }
            }
            echo "</Replies>";
            echo "</topic>";
        }
        echo "</Topics>";
    }
    mysqli_close($link);
}
?>