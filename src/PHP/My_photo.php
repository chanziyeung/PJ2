<?php

function show($pageNum = 1, $pageSize = 3)
{
    $array = array();
    $conn = mysqli_connect('localhost', 'root', 'a45224522.', 'pj2_user'); //准备SQL语句
    $sql_select = "SELECT ImageID,Title,Description,PATH FROM temp_myphoto limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
    $ret = mysqli_query($conn, $sql_select);
    while ($obj = mysqli_fetch_object($ret)) {
        $array[] = $obj;
    }

    return $array;
}

//显示总页数的函数
function all()
{
    $conn = mysqli_connect('localhost', 'root', 'a45224522.', 'pj2_user'); //准备SQL语句
    $sql_select = "SELECT count(*) num FROM temp_myphoto";
    $ret = mysqli_query($conn, $sql_select);
    $obj = mysqli_fetch_object($ret);

    return $obj->num;
}

$allNum = all();
$pageSize = 5; //约定每页显示几条信息
$pageNum = empty($_GET["pageNum"]) ? 1 : $_GET["pageNum"];
$endPage = ceil($allNum / $pageSize); //总页数
$array = show($pageNum, $pageSize);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../CSS/My_photo.css">
    <link rel="stylesheet" type="text/css" href="../CSS/reset.css">
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
        <li>
            <a href="Home.php">Home</a>
        </li>
        <li>
            <a href="Browse.php">Browse</a>
        </li>
        <li id="Search">
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
    <div class="content_title">
        <span>My Photo</span>
    </div>
<?php
if ($allNum==0){
$span = "<div class='remind'><span>You haven't uploaded a photo yet!</span></div>";
echo $span;
}
?>


    <?php
    foreach ($array as $key => $values) {
        $key = $key + 1;
        $content_box_num = '<div class=content_box' . $key . '>';
        echo $content_box_num;
        echo '<div class="image_box">';
        $href = '<a href="My_Photo_Details.php?ImageID=' . $values->ImageID . '">';
        echo $href;
        $img = '<img src="../../large/' . $values->PATH . '">';
        echo $img;
        echo ' </a>';
        echo '</div>';
        echo '<div class=content_box' . $key . '_title>';
        echo '<span>' . $values->Title . '</span>';
        echo '</div>';
        echo '<div class=description_box' . $key . '>';
        echo '<p>' . $values->Description . '</p>';
        echo '</div>';


        $form1 = '<form method="post" action="My_Photo_Edit.php?ImageID=' . $values->ImageID . '">';
        echo $form1;
        echo '<input type="submit" value="Modify" class="bt_modify m">';
        echo '</form>';

        $form = '<form method="post" action="My_Photo_delete.php?ImageID=' . $values->ImageID . '">';
        echo $form;
        echo '<input type="submit" value="Delete" class="bt_delete">';
        echo '</form>';

        echo '</div>';
    }
    ?>
</div>
<div id="navDiv" class="page">
    <span>共<?php echo $allNum ?>条记录</span>
    <span>共计<?php echo $endPage ?>页</span>
    <a class="page_first"
       href="My_photo.php?pageNum=1">首页</a>
    <a class="page_prev"
       href="My_photo.php?pageNum=<?php echo $pageNum == 1 ? 1 : ($pageNum - 1) ?>">上一页</a>
    <?php
    echo '<a class="a" class="page_current" href="My_photo.php?pageNum=1">1</a> ';

    for ($i = 2; $i <= $endPage; $i++) {
        echo '<a  class="a" class="page_other" href="My_photo.php?pageNum=' . $i . '">' . $i . '</a> ';
    }
    ?>
    <a class="page_next"
       href="My_photo.php?pageNum=<?php echo $pageNum == $endPage ? $endPage : ($pageNum + 1) ?>">下一页</a>
    <a class="page_last"
       href="My_photo.php?pageNum=<?php echo $endPage ?>">尾页</a>
</div>
<div class="footer">
    <span>Copyright &copy; 2020 SOFT1300002. All rights reserved.</span>
</div>

</body>
</html>
<script>
    window.onload = function () {
        var allA = document.getElementsByClassName("a");
        var index = <?php echo $pageNum ?>-1;
        allA[index].style.color = "red";

    }
</script>