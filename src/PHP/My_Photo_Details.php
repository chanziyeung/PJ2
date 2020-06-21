<?php
$imageID = isset($_GET['ImageID']) ? (integer)$_GET['ImageID'] : 0;


$conn = mysqli_connect('localhost', 'root', 'a45224522.', 'pj2_user'); //准备SQL语句
$sql_select = "SELECT ImageID,Title,Description,PATH,City,Country,Content FROM temp_myphoto where ImageID={$imageID}";
$ret = mysqli_query($conn, $sql_select);
$row = $ret->fetch_assoc();



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../CSS/Details.css">
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
                </ul>
                ";
            } else {

                echo "<span><a href='Login.php'>Login</a></span>";
            }
            ?>
            <!--            <span><a>My account</a></span>-->
            <!--            <ul class="nav1-content">-->
            <!--                <li>-->
            <!--                    <a href="Upload.html">Upload</a>-->
            <!--                </li>-->
            <!--                <li>-->
            <!--                    <a href="#">My Photo</a>-->
            <!--                </li>-->
            <!--                <li>-->
            <!--                    <a href="#">My Favor</a>-->
            <!--                </li>-->
            <!--
            <li>
                <a href="index.html">Login</a>
            </li>
-->
            <!--            </ul>-->
        </li>
    </ul>


    <ul class="nav">
        <li>
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
    <div class="box1">
        <span>Details</span>
    </div>

    <div class="title">
        <?php
        $title = '<span>' . $row["Title"] . '</span>';
        echo $title;
        ?>
        <!--        <span>--><?php //echo $show['title'];?><!--</span>-->
        <!--        <sub>by 天空一朵云</sub>-->
    </div>

    <div class="box2">
        <div class="image_box">
            <?php
            $img = '<img src="../../large/' . $row['PATH'] . '">';
            echo $img;

            ?>
            <!--        <img src="../../Image/image1.jpg" alt=" ">-->
        </div>
    </div>
    <div class="box3">
        <div class="box3_1">
            <div class="like_number">
                <span>Like Number</span>
            </div>
            <table>
                <tr>
                    <td>
                        <span>99</span>
                    </td>
                </tr>
            </table>
        </div>
        <div class="box3_2">
            <div class="image_details">
                <span>Image Details</span>
            </div>
            <table>
                <tr>
                    <td>
                        <?php
                        $content = '<span>Content: '.$row['Content'].' </span>';
                        echo $content;
                        ?>

                        <!--                        <span>Content: Scenery</span>-->
                    </td>
                </tr>
                <tr>
                    <td>

                        <?php
                        $content = '<span>Country: ' . $row["Country"] . '</span>';
                        echo $content;
                        ?>
                        <!--                        <span>Country: China</span>-->

                    </td>
                </tr>
                <tr>
                    <td>
                        <!--                        <span>City: Shanghai</span>-->
                        <?php
                        $city = '<span> City:' . $row["City"] . '</span>';
                        echo $city;
                        ?>
                    </td>
                </tr>
            </table>

            <form action="details_add.php?" method="post">
                <input type="hidden" value="<?php echo $row["ImageID"] ?>"  name="imageid" >
                <input type="hidden" value="<?php echo $row["Title"] ?>"  name="title" >
                <input type="hidden" value="<?php echo $row["Description"] ?>"  name="description" >
                <input type="hidden" value="<?php echo $row["Latitude"] ?>"  name="latitude" >
                <input type="hidden" value="<?php echo $row["Longitude"] ?>"  name="longitude" >
                <input type="hidden" value="<?php echo $row["CityCode"] ?>"  name="cityCode" >
                <input type="hidden" value="<?php echo $row["Country_RegionCodeISO"] ?>"  name="country_RegionCodeISO" >
                <input type="hidden" value="<?php echo $row["UID"] ?>"  name="UID" >
                <input type="hidden" value="<?php echo $row["PATH"] ?>"  name="path"" >
                <input type="hidden" value="<?php echo $row["content"] ?>"  name="content" >
                <input  id="button" type="submit" value="收藏" class="summit"">
            </form>


        </div>
    </div>

    <div class="box4">
        <?php
        $description = '<span>' . $row['Description'] . '</span>';
        echo $description;
        ?>
        <!--        <span>There is X'Building.There is X'Building.There is X'Building.There is X'Building.There is X'Building.There is X'Building.There is X'Building.There is X'Building.There is X'Building.There is X'Building.There is X'Building.There is X'Building.There is X'Building.There is X'Building.</span>-->
    </div>


</div>

<div class="footer">
    <span>Copyright &copy; 2020 SOFT1300002. All rights reserved.</span>
</div>
</body>
</html>