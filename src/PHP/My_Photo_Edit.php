<?php


$conn = mysqli_connect('localhost', 'root', 'a45224522.', 'pj2_user');
$ImageID = isset($_GET['ImageID'])?(integer)$_GET['ImageID']:0;

$sql = "select * from temp_myphoto where ImageID={$ImageID}";
$res = mysqli_query($conn, $sql);
$changeValue = mysqli_fetch_assoc($res);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../CSS/Upload.css">
    <link rel="stylesheet" type="text/css" href="../CSS/reset.css">

    <script type="text/javascript">
        function uploadImg() {
            var _name, _fileName, personsFile;
            personsFile = document.getElementById("file");
            _name = personsFile.value;
            _fileName = _name.substring(_name.lastIndexOf(".") + 1).toLowerCase();
            if (_fileName !== "png" && _fileName !== "jpg") {
                alert("上传图片格式不正确，请重新上传");
            } else {
                document.getElementById("showImg").src = window.URL.createObjectURL(personsFile.files[0]);
            }
        }
    </script>


</head>
<body>
<div class="header">
    <ul class="nav1">
        <li>
            <?php
            session_start();
            $username = isset($_SESSION['user']) ? $_SESSION['user'] : ""; //判断session是否为空
            if (empty($username)){
                header("location:Login.php");
            }

            if (!empty($username)) {
                echo "<span><a>$username</a></span>
            <ul class='nav1-content'>
                <li>
                    <a href='Upload.php'>Upload</a>
                </li>
                <li>
                    <a href='My_photo.php'>My Photo</a>
                </li>
                <li>
                    <a href='My_Favor.php'>My Favor</a>
                </li>
            </ul>
            ";
            } else {

                echo "<span><a href='Login.php'>Login</a></span>";
            }
            ?>

        </li>
    </ul>


    <ul class="nav">
        <li id="Home">
            <a href="Home.php">Home</a>
        </li>
        <li>
            <a href="Browse.php">Browse</a>
        </li>
        <li>
            <a href="Search.php">Search</a>
        </li>
    </ul>

    <div class="logo">
        <a href="Home.php">
            <img src="../../Image/logo.png" alt="网站的logo"/>
        </a>
    </div>

</div>

<div class="content">

    <form action="My_Photo_Update.php?ImageID=<?php echo $changeValue['ImageID'];?>" method="post"">
        <div class="content_title">
            <span>Upload</span>
        </div>

        <div class="upload">
            <div id="upload_box">
                <img id="showImg" src="../../large/<?php echo $changeValue['PATH'];?>">
                <h1>Picture Not Uploaded</h1>
            </div>
        </div>

        <div class="upload_content">
            <input type="hidden" name="ImageID" required="required" value="<?php echo $changeValue['ImageID'];?>"/>
            <span>Title:</span>
            <br>
            <input type="text" name="title" required="required" value="<?php echo $changeValue['Title'];?>" class="input_box">
            <br>
            <span>Description:</span>
            <br>
            <textarea type="text" name="description" required="required" class="textarea_box"><?php echo $changeValue['Description'];?></textarea>
            <br>
            <span>Country:</span>
            <br>
            <input type="text" name="country" required="required" value="<?php echo $changeValue['Country'];?>" class="input_box">
            <br>
            <span>City:</span>
            <br>
            <input type="text" name="city" required="required" value="<?php echo $changeValue['City'];?>" class="input_box">
            <br>
            <input type="submit" value="update"  class="input_filter">
        </div>
    </form>


</div>
<div class="footer">
    <span>Copyright &copy; 2020 SOFT1300002. All rights reserved.</span>
</div>
</body>
</html>
