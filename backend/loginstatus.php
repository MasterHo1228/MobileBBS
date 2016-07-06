<?php
/**
 * Created by IntelliJ IDEA.
 * User: MasterHo
 * Date: 2016/5/31
 * Time: 17:48
 */
session_start();
if (!empty($_SESSION['uID'])) {
    echo "login";
}
?>