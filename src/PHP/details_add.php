<?php
$conn = mysqli_connect('localhost', 'root', 'a45224522.', 'pj2_user');


$imageid = $_POST['imageid'];
if (!empty($_POST["imageid"])) {
    $imageid = $_POST["imageid"];
}
$title = $_POST['title'];
if (!empty($_POST["title"])) {
    $title = $_POST["title"];
}
$description = $_POST['description'];
if (!empty($_POST["description"])) {
    $description = $_POST["description"];
}
$latitude = $_POST['latitude'];
if (!empty($_POST["latitude"])) {
    $latitude = $_POST["latitude"];
}
$longitude = $_POST['longitude'];
if (!empty($_POST["longitude"])) {
    $longitude = $_POST["longitude"];
}
$cityCode = $_POST['cityCode'];
if (!empty($_POST["cityCode"])) {
    $cityCode = $_POST["cityCode"];
}
$country_RegionCodeISO= $_POST['country_RegionCodeISO'];
if (!empty($_POST["country_RegionCodeISO"])) {
    $country_RegionCodeISO = $_POST["country_RegionCodeISO"];
}
$UID = $_POST['UID'];
if (!empty($_POST["UID"])) {
    $UID = $_POST["UID"];
}
$path = $_POST['path'];
if (!empty($_POST["path"])) {
    $path = $_POST["path"];
}
$content = $_POST['content'];
if (!empty($_POST["content"])) {
    $content = $_POST["content"];
}

$sql_insert="insert into temp_myfavor1 values ('{$imageid}','{$title}','{$description}','{$latitude}','{$longitude}','{$cityCode}','{$country_RegionCodeISO}','{$UID}','{$path}','{$content}')";
$res = mysqli_query($conn,$sql_insert);

if(! $res )
{
    die ('无法插入数据: ' . mysqli_error($conn));
}else
header("location:My_Favor.php");





