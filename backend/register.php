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
    $usrName = htmlentities((mysqli_real_escape_string($link, $_POST['user'])),ENT_QUOTES,'UTF-8');
    $usrPass = htmlentities((mysqli_real_escape_string($link, $_POST['password'])),ENT_QUOTES,'UTF-8');
    $usrSex = htmlentities((mysqli_real_escape_string($link, $_POST['sex'])),ENT_QUOTES,'UTF-8');
    $usrTName = htmlentities((mysqli_real_escape_string($link, $_POST['tName'])),ENT_QUOTES,'UTF-8');
    $usrDateOfBirth = htmlentities((mysqli_real_escape_string($link, $_POST['DateOfBirth'])),ENT_QUOTES,'UTF-8');
    $usrEmail = htmlentities((mysqli_real_escape_string($link, $_POST['Email'])),ENT_QUOTES,'UTF-8');
    $usrSign = htmlentities((mysqli_real_escape_string($link, $_POST['usrSign'])),ENT_QUOTES,'UTF-8');

    $strsql = "INSERT INTO bbsUser(uName,uPassWord,uSex,uTrueName,uDateOfBirth,uEmail,uSign) VALUES ('$usrName','$usrPass','$usrSex','$usrTName','$usrDateOfBirth','$usrEmail','$usrSign');";
    if (mysqli_query($link, $strsql)) {
        echo "<script>alert('注册成功！');history.go(-1);</script>";
    } else {
        echo "<script>alert(mysqli_error($link))</script>";
    }

    mysqli_close($link);
}
?>
