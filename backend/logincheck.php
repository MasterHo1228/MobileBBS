<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2016-05-05
 * Time: 10:26
 */
session_start();
header("Content-type: text/html; charset=utf-8");
if (!empty($_POST['usrName']) && !empty($_POST['usrPW'])) {
    require_once("dbconn.php");
    $usrName = mysqli_real_escape_string($link, $_POST['usrName']);
    $usrPW = mysqli_real_escape_string($link, $_POST['usrPW']);

    $strsql = "SELECT uID,uName,uPassWord FROM bbsUser WHERE uName='$usrName' AND uPassWord='$usrPW'";
    $query = mysqli_query($link, $strsql);
    if (mysqli_num_rows($query) == 1) {
        while ($rs = mysqli_fetch_array($query)) {
            $_SESSION['uID'] = $rs['uID'];
        }
        echo "<script>alert('登录成功！');location.href='index.html#Forum';</script>";
    } else {
        echo "<script>alert('登录失败！')</script>";
    }
    mysqli_close($link);
}
?>

