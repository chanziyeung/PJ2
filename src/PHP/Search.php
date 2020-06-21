<?php

error_reporting(E_ALL || ~E_NOTICE);
$id = isset($_GET['id']) ? $_GET['id'] : "1";
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
}
if ($_GET['id'] == 2) {
    $id = 2;
} else
    $id = 1;
$radio = isset($_GET['Filter']) ? $_GET['Filter'] : 1;


$key = $_GET['keywords'];
if (!empty($_GET["keywords"])) {
    $key = $_GET["keywords"];
}
define('str_key', $key);

$description = $_GET['description'];
if (!empty($_GET["description"])) {
    $description = $_GET["description"];
}
define('str_key1', $description);


function show($pageNum = 1, $pageSize = 3)
{
    global $key;
    global $id;
    global $description;
    $array = array();
    $coon = mysqli_connect('localhost', 'root', 'a45224522.', 'pj2_user'); //准备SQL语句

    if ($id == 0) {
        $rs = "SELECT imageid,Title,Description,path FROM travelimage where path is not null limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
        $r = mysqli_query($coon, $rs);
        while ($obj = mysqli_fetch_object($r)) {
            $array[] = $obj;
        }
    }

    if ($id == 1) {
        if (!empty($_GET['keywords'])) {
            $sql_select_search = "SELECT title,imageid,description,path FROM travelimage where  title like '%$key%'limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
            $ret1 = mysqli_query($coon, $sql_select_search);
            while ($obj = mysqli_fetch_object($ret1)) {
                $array[] = $obj;
            }
        }
        if (!empty($_GET['description'])) {
            $sql_select_content = "SELECT imageid,title,description,path FROM travelimage where Description like '%$description%' limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
            $rs = mysqli_query($coon, $sql_select_content);
            while ($obj = mysqli_fetch_object($rs)) {
                $array[] = $obj;
            }
        }
    }
    return $array;
}

//显示总页数的函数
function all()
{
    global $id;
    global $key;
    global $description;
    $coon = mysqli_connect('localhost', 'root', 'a45224522.', 'pj2_user');

    if ($id == 1) {
        if (!empty($_GET['keywords'])) {
            $rs = "select count(*) num from travelimage where title like '%$key%'";
            $r = mysqli_query($coon, $rs);
            $obj = mysqli_fetch_object($r);
        }

        if (!empty($_GET['description'])) {
            $sql_select_content = "SELECT count(*) num FROM travelimage where Description like '%$description%'";
            $rs = mysqli_query($coon, $sql_select_content);
            $obj = mysqli_fetch_object($rs);
        }
    }

    if ($id == 0) {
        $sql_select_search = "select count(*) num from travelimage";
        $ret1 = mysqli_query($coon, $sql_select_search);
        $obj = mysqli_fetch_object($ret1);
    }

    return $obj->num;
}

$allNum = all();
$pageSize = 5;
$pageNum = empty($_GET["pageNum"]) ? 1 : $_GET["pageNum"];
$endPage = ceil($allNum / $pageSize);
if ($endPage>=5){
    $endPage=5;
}


$array = show($pageNum, $pageSize);
?>

<!DOCTYPE>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../CSS/Search.css">
    <link rel="stylesheet" type="text/css" href="../CSS/reset.css">
</head>
<body>
<div class="header">
    <ul class="nav1">
        <li>
            <?php
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
<div class="search">
    <div class="search_title">
        <span>Search</span>
    </div>

    <div class="search_content">
        <form name="myform" action="Search.php?id=1&keywords=<?php echo $key ?>&description=<?php echo $description ?>"
              method="get">
            <input type="radio" name="Filter" id="box" value="1"

                <?php if (isset($radio) && $radio == 1) echo "checked"; ?>

            >Filter by Title
            <br>
            <input type="text" name="keywords" id="text" onclick="check()" onblur="value_to()" value="<?php echo $key ?>" class="search_box1">
            <br>

            <input type="radio" name="Filter" id="box1" value="0" "
            <?php if (isset($radio) && $radio == 0) echo "checked";
            echo text . $value = "";
            ?>
            >
            Filter by Description
            <br>
            <textarea type="text" name="description" id="text" onclick="check1()" onblur="value_to1()" value="<?php echo $description ?>"
                      class="search_box2"></textarea>
            <br>

            <input type="submit" value="Filter" id="submit" class="input_filter">
        </form>
    </div>


</div>
<div class="result">
    <div class="result_title">
        <span>Result</span>
    </div>

    <?php
    foreach ($array as $key => $values) {
        $key = $key + 1;
        $result_box_num = '<div class=result_box' . $key . '>';
        echo $result_box_num;
        echo '<div class="image_box">';
        $href = '<a href="Details.php?ImageID=' . $values->imageid . '">';
        echo $href;
        $img = '<img src="../../large/' . $values->path . '">';
        echo $img;
        echo ' </a>';
        echo '</div>';
        echo '<div class=result_box' . $key . '_title>';
        echo '<span>' . $values->title . '</span>';
        echo '</div>';
        echo '<div class=description_box' . $key . '>';
        echo '<p>' . $values->description . '</p>';
        echo '</div>';
        echo '</div>';
    }
    ?>


</div>

<div id="navDiv" class="page">
    <span>共<?php echo $allNum ?>条记录</span>
    <span>共计<?php echo $endPage ?>页</span>
    <a class="page_first"
       href="Search.php?pageNum=1&keywords=<?php echo str_key ?>&description=<?php echo $description ?>">首页</a>
    <a class="page_prev"
       href="Search.php?pageNum=<?php echo $pageNum == 1 ? 1 : ($pageNum - 1) ?>&keywords=<?php echo str_key ?>&description=<?php echo $description ?>">上一页</a>
    <?php
    echo '<a class="a" class="page_current" href="Search.php?pageNum=1&keywords=' . str_key . '&description=' . $description . '">1</a> ';

    for ($i = 2; $i <= $endPage; $i++) {
        echo '<a class="a" class="page_other" href="Search.php?pageNum=' . $i . '&keywords=' . str_key . '&description=' . $description . '">' . $i . '</a> ';
    }
    ?>
    <a class="page_next"
       href="Search.php?pageNum=<?php echo $pageNum == $endPage ? $endPage : ($pageNum + 1) ?>&keywords=<?php echo str_key ?>&description=<?php echo $description ?> ">下一页</a>
    <a class="page_last"
       href="Search.php?pageNum=<?php echo $endPage ?>&keywords=<?php echo str_key ?>&description=<?php echo $description ?>">尾页</a>
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

    };
</script>
<script>
    function check() {
        document.getElementById("box").checked = true;
        document.getElementById("text1").value="";
    }

    function value_to() {
        var x = document.getElementById("text").value;
        document.getElementById("box").value = x;
    }

    function check1() {
       document.getElementById("text").value="";
        document.getElementById("box1").checked = true;
    }

    function value_to1() {
        var y = document.getElementById("text1").value;
        document.getElementById("box1").value = y;
    }
</script>

