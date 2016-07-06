<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/5/6
 * Time: 19:02
 */
session_start();
if (!empty($_SESSION['uID'])) {
    unset($_SESSION['uID']);
    unset($_SESSION['topicID']);
    echo "<script>alert('已登出~~');location.reload();</script>";
} else {
    echo "<script>alert('亲，你现在还没登录网站呦~~');history.go(-1);</script>";
}
?>