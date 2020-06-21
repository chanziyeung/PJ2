<?php
$conn = mysqli_connect('localhost', 'root', 'a45224522.', 'pj2_user');
$ImageID = isset($_GET['ImageID'])?(integer)$_GET['ImageID']:0;

$sql = "delete from temp_myfavor1 where ImageID=".$ImageID;
$res = mysqli_query($conn, $sql);

if(! $res )
{
    die ('无法删除数据: ' . mysqli_error($conn));
}else
    header("location:My_Favor.php");
