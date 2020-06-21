<?php
$flag = isset($_GET['flag']) ? $_GET['flag'] : "0";

function outputGenres()
{

    try {
        global $flag;
        $conn = mysqli_connect('localhost', 'root', 'a45224522.', 'pj2_user'); //准备SQL语句
        $sql_select_image = 'SELECT min(travelimagefavor.imageid),Title,Description,path, travelimagefavor.uid, travelimage.imageid  FROM travelimage 
INNER JOIN travelimagefavor ON travelimage.imageid = travelimagefavor.imageid where Description is not null group by imageid order by favorid desc   ';
        $ret = mysqli_query($conn, $sql_select_image);

        $sql_select_image1 = "SELECT imageid,Title,Description,path FROM travelimage where Description is not null order by rand() limit 6 ";
        $ret1 = mysqli_query($conn, $sql_select_image1);
        if ($flag == 0) {
            for ($i = 1; $i <= 6; $i++) {
                $row = $ret->fetch_assoc();
                outputSingleGenre($row, $i);
            }
        } else if ($flag == 1) {
            for ($i = 1; $i <= 6; $i++) {
                $row = $ret1->fetch_assoc();
                outputSingleGenre($row, $i);
            }
        }

        $conn = null;

    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function outputSingleGenre($row, $i)
{
    $box_num = '<div class=box' . $i . '>';
    echo $box_num;
    $title = '<h1>' . $row["Title"] . '</h1>';
    echo $title;
    echo '<div class="image_box">';
    $href = '<a href="Details.php?ImageID=' . $row['imageid'] . '">';
    echo $href;

    $img = '<img src="../../large/' . $row['path'] . '">';
    echo $img;
    echo ' </a>';
    echo '</div>';
    echo '<p class="p1">';
    $description = $row['Description'];
    echo $description;
    echo '</p>';
    echo '</div>';

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../CSS/Home.css">
    <link rel="stylesheet" type="text/css" href="../CSS/reset.css">

    <link rel="stylesheet" href="../CSS/Banner.css">
</head>
<body>
<div class="header">
    <ul class="nav1">
        <li>
            <?php
            /**
             * 判断用户是否登录
             */
            session_start();
            $username = isset($_SESSION['user']) ? $_SESSION['user'] : ""; //判断session是否为空
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
                <li>
                    <a href='LogOut.php'>Log Out</a>
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

<div class="banner">
    <div class="image1">
        <div class="wrap" style="-1000px;">
                <img id="b_img" src="../../Image/browse_image1.jpg" alt="头图"/>
                <img id="b_img" src="../../Image/browse_image2.jpg" alt="头图"/>
                <img id="b_img" src="../../Image/browse_image3.jpg" alt="头图"/>
                <img id="b_img" src="../../Image/browse_image4.jpg" alt="头图"/>
                <img id="b_img" src="../../Image/browse_image5.jpg" alt="头图"/>
        </div>
        <div class="buttons">
            <span class="b_span" class="on">1</span>
            <span class="b_span">2</span>
            <span class="b_span">3</span>
            <span class="b_span">4</span>
            <span class="b_span">5</span>
        </div>
        <a href="javascript:" class="arrow arrow_left">&lt;</a>
        <a href="javascript:" class="arrow arrow_right">&gt;</a>
    </div>
    <script type="text/javascript" src="../JS/jquery-3.3.1.min.js"></script>
    <script src="../JS/Banner.js"></script>
</div>

<div class="content w">
    <h1>The photos will be recorded a thing called youth.</h1>
    <?php outputGenres(); ?>
</div>


<div class="footer">
    <div id="button">
        <a id="top" href="javascript:window.scrollTo(0,0)"></a>

        <form action="Home.php?flag=1" method="post">
            <input class="reload" type="image" src="../../Image/reload.png">
            </input>
        </form>


    </div>
    <div class="footer_content_left">
        <p><a href=""> TERMS OF USE</a></p>
        <p><a href=""> PRIVACY POLICY</a></p>
        <p><a href="">COOKIE</a></p>
    </div>

    <div class="footer_content_middle">
        <p><a href="#">CONTACT US</a></p>
        <p><a href="#">ABOUT</a></p>
    </div>

    <div class="footer_content_right">
        <img src="../../Image/twitter.png" alt="">
        <img src="../../Image/wechat.png" alt="">
        <br>
        <img src="../../Image/face-book.png" alt="">
        <img src="../../Image/ins.png" alt="">
    </div>

    <!-- <span>Copyright &copy; 2020 SOFT1300002. All rights reserved.</span> -->
</div>
</body>
</html>
