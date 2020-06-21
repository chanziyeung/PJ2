<?php

$conn = mysqli_connect('localhost', 'root', 'a45224522.', 'pj2_user');
$ImageID = isset($_GET['ImageID'])?(integer)$_GET['ImageID']:0;

$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$description = isset($_POST['description']) ? trim($_POST['description']) : '';
$country = isset($_POST['country']) ? trim($_POST['country']) : '';
$city = isset($_POST['city']) ? trim($_POST['city']) : '';


$sql = "UPDATE temp_myphoto SET Title='{$title}', Description='{$description}',Country='{$country}',City='{$city}' where ImageID={$ImageID}";
$res = mysqli_query($conn, $sql);


if (!$res) {
    die('无法更新数据: ' . mysqli_error($conn));
}
else
    header('location:My_photo.php');
