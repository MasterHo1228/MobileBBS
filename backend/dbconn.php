<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/5/5
 * Time: 22:36
 */
//以下所定义的变量存储MySQL link所需要的参数值，需要更改参数直接更改变量值即可 不用改动下面主要的代码
$dbLink = "127.0.0.1";
$dbUser = "root";
$dbPassW = "";
$dbName = "webBBS";

$link = mysqli_connect($dbLink, $dbUser, $dbPassW, $dbName);
if (mysqli_connect_errno($link)) {
    echo "连接失败: " . mysqli_connect_error();
}
mysqli_query($link, "set names 'utf8';");
?>