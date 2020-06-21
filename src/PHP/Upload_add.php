<?php
$conn = mysqli_connect('localhost', 'root', 'a45224522.', 'pj2_user');
if ($_FILES["file"]["error"] > 0) {
    echo "错误：" . $_FILES["file"]["error"] . "<br>";
} else {
    echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
    echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
    echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"];
}


$title = $_POST['title'];
if (!empty($_POST["title"])) {
    $title = $_POST["title"];
}
$description = $_POST['description'];
if (!empty($_POST["description"])) {
    $description = $_POST["description"];
}
$country = $_POST['country'];
if (!empty($_POST["country"])) {
    $country = $_POST["country"];
}
$city = $_POST['city'];
if (!empty($_POST["city"])) {
    $city = $_POST["city"];
}
$content = $_POST['content'];
$input = $_POST['input'];
if (!empty($_POST["content"])) {
    $content = $_POST["content"];
} else {
    $content = $input = $_POST["input"];
}

$sql_insert = "insert into temp_myphoto values (null,'{$title}','{$description}','{$country}','{$city}','{$_FILES["file"]["name"]}','{$content}')";
$res = mysqli_query($conn, $sql_insert);

if (!$res) {
    die ('无法插入数据: ' . mysqli_error($conn));
} else
    header("location:My_Photo.php");
?>


