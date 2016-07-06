<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/5/5
 * Time: 22:57
 */
if (!empty($_POST['user']) && !empty($_POST['password'])) {
    //召唤MySQL大法
    require_once("dbconn.php");

    //获取表单值
    $usrName = mysqli_real_escape_string($link, $_POST['user']);
    $usrPass = mysqli_real_escape_string($link, $_POST['password']);
    $usrSex = mysqli_real_escape_string($link, $_POST['sex']);
    $usrTName = mysqli_real_escape_string($link, $_POST['tName']);
    $usrDateOfBirth = mysqli_real_escape_string($link, $_POST['DateOfBirth']);
    $usrEmail = mysqli_real_escape_string($link, $_POST['Email']);
    $usrSign = mysqli_real_escape_string($link, $_POST['usrSign']);

    $strsql = "INSERT INTO bbsUser(uName,uPassWord,uSex,uTrueName,uDateOfBirth,uEmail,uSign) VALUES ('$usrName','$usrPass','$usrSex','$usrTName','$usrDateOfBirth','$usrEmail','$usrSign');";
    if (mysqli_query($link, $strsql)) {
        echo "<script>alert('注册成功！');history.go(-1);</script>";
    } else {
        echo "<script>alert(mysqli_error($link))</script>";
    }

    mysqli_close($link);
}
?>
