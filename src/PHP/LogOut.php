<?php
session_start();
$username = isset($_SESSION['user']) ? $_SESSION['user'] : "";
if(isset($_SESSION['user']) && $_SESSION['user']==$username){
    session_unset();//free all session variable
    session_destroy();//销毁一个会话中的全部数据
    setcookie(session_name(),'',time()-3600);//
    header('location:Login.php');
}echo 'no';
?>
