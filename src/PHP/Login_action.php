<?php
session_start();
$username = isset($_POST['username']) ? $_POST['username'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";

if (!empty($username) && !empty($password)) { //建立连接
    $conn = mysqli_connect('localhost', 'root', 'a45224522.', 'pj2_user');
    $sql_select = "SELECT username,password FROM usertext WHERE username = '$username' AND password = '$password'";
    $ret = mysqli_query($conn, $sql_select);
    $row = mysqli_fetch_array($ret);
    if ($username == $row['username'] && $password == $row['password']) { //判断用户名或密码是否正确
        session_start(); //创建session
        $_SESSION['user'] = $username;
        header("Location:Home.php");
        mysqli_close($conn);
    }
    else
    {
        //用户名或密码错误，赋值err为1
        header("Location:Login.php?err=1");
    }
} else { //用户名或密码为空，赋值err为2
    header("Location:Login.php?err=2");
} ?>

