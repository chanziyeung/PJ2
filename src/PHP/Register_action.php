<?php


$username = isset($_POST['username']) ? $_POST['username'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$re_password = isset($_POST['re_password']) ? $_POST['re_password'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";



if ($password == $re_password) { //建立连接
    $conn = mysqli_connect("localhost", "root", "a45224522.", "pj2_user");
    $sql_select = "SELECT username FROM usertext WHERE username = '$username'";
    $ret = mysqli_query($conn, $sql_select);
    $row = mysqli_fetch_array($ret); //判断用户名是否已存在
    if ($username == $row['username']) { //用户名已存在，显示提示信息
        header("Location:Register.php?err=1");
    } else {
        $sql_insert = "INSERT INTO usertext(username,email,password)VALUES('$username','$email','$password')"; //插入数据
        mysqli_query($conn, $sql_insert);
        header("Location:Register.php?err=3;");
        header("url='Login.php';");
    } //关闭数据库
    mysqli_close($conn);
} else if ($password != $re_password) {
    header("Location:Register.php?err=2");
}
if (!preg_match("/^[a-z0-9_-]{3,16}$/", $username)) {
    header("Location:Register.php?err=4");
}
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
    header("Location:Register.php?err=5");
}
if (!preg_match("/^[a-z0-9_-]{6,18}$/",$password)) {
    header("Location:Register.php?err=6");
}




?>
