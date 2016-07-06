<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/5/31
 * Time: 18:23
 */
session_start();
header("Content-type: text/html; charset=utf-8");
if (!empty($_SESSION['uID'])) {
    $uID = $_SESSION['uID'];
    require_once("dbconn.php");

    $strsql = "SELECT uID,uName,uSex,uTrueName,uDateOfBirth,uEmail,uSign FROM bbsuser WHERE uID='$uID'";
    $query = mysqli_query($link, $strsql);
    while ($rs = mysqli_fetch_array($query)) {
        $uID = $rs['uID'];
        $uName = $rs['uName'];
        @$uSex = $rs['uSex'];
        @$uTrueName = $rs['uTrueName'];
        @$uDateOfBirth = $rs['uDateOfBirth'];
        @$uEmail = $rs['uEmail'];
        @$uSign = $rs['uSign'];

        echo "<ul>";
        echo "<li>用户ID:" . $uID . "</li>";
        echo "<li>用户名:" . $uName . "</li>";
        echo "<li>性别:" . $uSex . "</li>";
        echo "<li>真实姓名:" . $uTrueName . "</li>";
        echo "<li>出生日期:" . $uDateOfBirth . "</li>";
        echo "<li>E-Mail:" . $uEmail . "</li>";
        echo "<li>签名:" . $uSign . "</li>";
        echo "</ul>";
    }
    mysqli_close($link);
} else {
    echo "<script>alert('亲，你现在还没登录网站呦~~');history.go(-1);</script>";
}
?>

