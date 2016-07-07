<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/7/7
 * Time: 12:02
 */
session_start();
header("Content-type: text/xml");
if (!empty($_SESSION['uID'])){
    echo "<UserID>".$_SESSION['uID']."</UserID>";
}
?>