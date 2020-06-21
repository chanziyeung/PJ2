<?php
error_reporting(E_ALL || ~E_NOTICE);
//$id = isset($_GET['id']) ? $_GET['id'] : "1";
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
} else if ($_GET['id'] == 2) {
    $id = 2;
} else if ($_GET['id'] == 3) {
    $id = 3;
} else
    $id = 1;
$content1 = $_GET['content1'];
if (!empty($_GET["content1"])) {
    $content1 = $_GET["content1"];
}
define('str_content1', $content1);

$city1 = $_GET['city1'];
if (!empty($_GET["city1"])) {
    $city1 = $_GET["city1"];
}
define('str_city1', $city1);


$key = $_GET['keywords'];
if (!empty($_GET["keywords"])) {
    $key = $_GET["keywords"];
}
define('str_key', $key);

$content = $_GET['content'];
if (!empty($_GET["content"])) {
    $content = $_GET["content"];
}
define('str_content', $content);

$country = $_GET['country'];
if (!empty($_GET["country"])) {
    $country = $_GET["country"];
}
define('str_country', $country);

$city = $_GET['city'];
if (!empty($_GET["city"])) {
    $city = $_GET["city"];
}
define('str_city', $city);


/**
 * 在数据库travelimage找出Country_RegionCodeISO出现次数最多的前五个，
 * 然后匹配geocountries_regions相对应的国家
 */
$conn = mysqli_connect('localhost', 'root', 'a45224522.', 'pj2_user');
$sq = "SELECT Country_RegionCodeISO, count(*) AS count FROM travelimage GROUP BY Country_RegionCodeISO ORDER BY `count` DESC LIMIT 0, 5";
$ret = mysqli_query($conn, $sq);
$arr = array();
for ($i = 0; $i < 5; $i++) {
    $row = $ret->fetch_assoc();
    $str = $row['Country_RegionCodeISO'];
    $arr[] = explode(" ", $str);
}

//将数组转换成字符串
$str = implode("", $arr[0]);
$str2 = implode("", $arr[1]);
$str3 = implode("", $arr[2]);
$str4 = implode("", $arr[3]);
$str5 = implode("", $arr[4]);


$sq1_country = "SELECT 	Country_RegionName,	ISO FROM geocountries_regions where ISO like '%$str%' ";
$ret1 = mysqli_query($conn, $sq1_country);
$showCountry1 = $ret1->fetch_assoc();


$sq2_country = "SELECT 	Country_RegionName,	ISO FROM geocountries_regions where ISO like '%$str2%' ";
$ret2 = mysqli_query($conn, $sq2_country);
$showCountry2 = $ret2->fetch_assoc();

$sq3_country = "SELECT 	Country_RegionName,	ISO FROM geocountries_regions where ISO like '%$str3%' ";
$ret3 = mysqli_query($conn, $sq3_country);
$showCountry3 = $ret3->fetch_assoc();

$sq4_country = "SELECT 	Country_RegionName,	ISO FROM geocountries_regions where ISO like '%$str4%' ";
$ret4 = mysqli_query($conn, $sq4_country);
$showCountry4 = $ret4->fetch_assoc();

$sq5_country = "SELECT 	Country_RegionName,	ISO FROM geocountries_regions where ISO like '%$str5%' ";
$ret5 = mysqli_query($conn, $sq5_country);
$showCountry5 = $ret5->fetch_assoc();

/**
 * 在数据库travelimage中找出CityCode出现次数最多的前五个，
 * 在数据库geocities中找出对应的城市
 */

$sq1 = "SELECT CityCode, count(*) AS count FROM travelimage where CityCode is NOT null GROUP BY CityCode ORDER BY `count` DESC LIMIT 0, 5";
$ret_city = mysqli_query($conn, $sq1);
$arr = array();
for ($i = 0; $i < 5; $i++) {
    $row = $ret_city->fetch_assoc();
    $str = $row['CityCode'];
    $arr[] = explode(" ", $str);
}
echo '<br>';
$str_city = implode("", $arr[0]);
$str2_city = implode("", $arr[1]);
$str3_city = implode("", $arr[2]);
$str4_city = implode("", $arr[3]);
$str5_city = implode("", $arr[4]);

$sq1_city = "SELECT GeoNameID,AsciiName FROM geocities where GeoNameID like '%$str_city%' ";
$ret1 = mysqli_query($conn, $sq1_city);
$showCity1 = $ret1->fetch_assoc();


$sq2_city = "SELECT GeoNameID,AsciiName FROM geocities where GeoNameID like '%$str2_city%' ";
$ret2 = mysqli_query($conn, $sq2_city);
$showCity2 = $ret2->fetch_assoc();

$sq3_city = "SELECT GeoNameID,AsciiName FROM geocities where GeoNameID like '%$str3_city%' ";
$ret3 = mysqli_query($conn, $sq3_city);
$showCity3 = $ret3->fetch_assoc();

$sq4_city = "SELECT GeoNameID,AsciiName FROM geocities where GeoNameID like '%$str4_city%' ";
$ret4 = mysqli_query($conn, $sq4_city);
$showCity4 = $ret4->fetch_assoc();

$sq5_city = "SELECT GeoNameID,AsciiName FROM geocities where GeoNameID like '%$str5_city%' ";
$ret5 = mysqli_query($conn, $sq5_city);
$showCity5 = $ret5->fetch_assoc();

/**
 * 将查询结果赋予给array
 */


function show($pageNum = 1, $pageSize = 3)
{
    global $key;
    global $id;
    global $content;
    global $country;
    global $city;
    global $city1;
    global $content1;
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
        if (!empty($_GET['content'])) {
            $sql_select_content = "SELECT imageid,Title,Description,path FROM travelimage where content like '%$content%' order by imageid desc limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
            // var_dump(str_key1);
            $rs = mysqli_query($coon, $sql_select_content);
            while ($obj = mysqli_fetch_object($rs)) {
                $array[] = $obj;
            }
        }
        if (!empty($_GET['country'])) {
            $sql_select_country = "SELECT imageid,Title,Description,path,travelimage.Country_RegionCodeISO,geocountries_regions.ISO,geocountries_regions.Country_RegionName FROM travelimage inner join geocountries_regions
 on geocountries_regions.ISO=travelimage.Country_RegionCodeISO
 where 	Country_RegionName 
        like '%$country%' order by imageid desc limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
            $ret2 = mysqli_query($coon, $sql_select_country);
            while ($obj = mysqli_fetch_object($ret2)) {
                $array[] = $obj;
            }
        }
        if (!empty($_GET['city'])) {
            $sql_select_city = "SELECT imageid,Title,Description,path,travelimage.CityCode,geocities.GeoNameID,geocities.AsciiName
 FROM travelimage inner join geocities
 on travelimage.CityCode=geocities.GeoNameID
 where 	AsciiName 
        like '%$city%' order by imageid desc limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
            $ret2 = mysqli_query($coon, $sql_select_city);
            while ($obj = mysqli_fetch_object($ret2)) {
                $array[] = $obj;
            }
        }
        if (!empty($_GET['content1']) && !empty($_GET['city1'])) {
            $sql_both = "SELECT imageid,Title,Description,path,travelimage.CityCode,geocities.GeoNameID,geocities.AsciiName
 FROM travelimage inner join geocities
 on travelimage.CityCode=geocities.GeoNameID
 where 	AsciiName 
        like '$city1' and content like '$content1' order by imageid desc limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
            $ret2 = mysqli_query($coon, $sql_both);
            while ($obj = mysqli_fetch_object($ret2)) {
                $array[] = $obj;
            }
        }
    }


    return $array;
}

/**
 *显示查询结果的总页数
 */
function all()
{
    global $id;
    global $key;
    global $content;
    global $country;
    global $city;
    global $content1;
    global $city1;
    $coon = mysqli_connect('localhost', 'root', 'a45224522.', 'pj2_user');
    if ($id == 1) {
        if (!empty($_GET['keywords'])) {
            $rs = "select count(*) num from travelimage where title like '%$key%'";
            $r = mysqli_query($coon, $rs);
            $obj = mysqli_fetch_object($r);
        }
        if (!empty($_GET['content'])) {
            $sql_select_search = "select count(*) num from travelimage where content like '%$content%'";
            $ret1 = mysqli_query($coon, $sql_select_search);
            $obj = mysqli_fetch_object($ret1);
        }
        if (!empty($_GET['country'])) {
            $sql_select_country = "SELECT  count(*) num FROM travelimage inner join geocountries_regions
 on geocountries_regions.ISO=travelimage.Country_RegionCodeISO
 where	Country_RegionName like '%$country%' order by imageid desc";
            $ret2 = mysqli_query($coon, $sql_select_country);
            $obj = mysqli_fetch_object($ret2);
        }
        if (!empty($_GET['city'])) {
            $sql_select_city = "SELECT count(*) num
 FROM travelimage inner join geocities
 on travelimage.CityCode=geocities.GeoNameID
 where 	AsciiName 
        like '%$city%' order by imageid desc ";
            $ret2 = mysqli_query($coon, $sql_select_city);
            $obj = mysqli_fetch_object($ret2);
        }
        if (!empty($_GET['content1']) && !empty($_GET['city1'])) {
            $sql_both = "SELECT  count(*) num
 FROM travelimage inner join geocities
 on travelimage.CityCode=geocities.GeoNameID
 where 	AsciiName 
        like '$city1' and content like '$content1' order by imageid desc ";
            $ret2 = mysqli_query($coon, $sql_both);
            $obj = mysqli_fetch_object($ret2);
        }
    }

    if ($id == 0) {
        // $sql_select_search = "SELECT count(*) num  FROM travelimage where title like '%$getText%'";
        $sql_select_search = "select count(*) num from travelimage";
        $ret1 = mysqli_query($coon, $sql_select_search);
        //var_dump($ret1);
        $obj = mysqli_fetch_object($ret1);
    }
    return $obj->num;
}

$allNum = all(); //查询总数
$pageSize = 16; //每页显示16个信息
$pageNum = empty($_GET["pageNum"]) ? 1 : $_GET["pageNum"];
$endPage = ceil($allNum / $pageSize); //总页数
$array = show($pageNum, $pageSize);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../CSS/reset.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Browse.css">
    <script src="../JS/country&city.js"></script>
</head>
<body>
<div class="header">
    <ul class="nav1">
        <li>
            <?php
            /**
             *用会话技术判断用户是否登录，如果没有记录，则不会伸出下拉框
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
        <li>
            <a href="Home.php">Home</a>
        </li>
        <li id="Browse">
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

    <div class="aside">

        <div class="search">
            <div class="search_title">
                <span>Search by Title</span>
            </div>

            <form action="Browse.php?id=1&keywords=<?php echo $key ?>" method="get">
                <label>
                    <input type="text" name="keywords" class="input_text" value="<?php echo $key ?>"
                           placeholder="Please enter search content">
                </label>
                <input type="submit" value="Search" class="input_sub" ">
            </form>
        </div>

        <div class="hotcontent">

            <div class="hotcontent_title">
                <span>Hot Content</span>
            </div>

            <table>
                <tr>
                    <td><span><a href="?id=1&content=scenery">Scenery</a></span></td>
                </tr>
                <tr>
                    <td><span><a href="?id=1&content=city">City</a></span></td>
                </tr>
                <tr>
                    <td><span><a href="?id=1&content=people">People</a></span></td>
                </tr>
                <tr>
                    <td><span><a href="?id=1&content=animal">Animal</a></span></td>
                </tr>
                <tr>
                    <td><span><a href="?id=1&content=building">Building</a></span></td>
                </tr>
                <tr>
                    <td><span><a href="?id=1&content=wonder">Wonder</a></span></td>
                </tr>
            </table>

        </div>

        <div class="hotcountry">

            <div class="hotcountry_title">
                <span>Hot Country</span>
            </div>

            <table>
                <tr>
                    <td>
                        <span><a href="?id=1&country=<?php echo $showCountry1['Country_RegionName'] ?>"><?php echo $showCountry1['Country_RegionName'] ?></a></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span><a href="?id=1&country=<?php echo $showCountry2['Country_RegionName'] ?>"><?php echo $showCountry2['Country_RegionName'] ?></a></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span><a href="?id=1&country=<?php echo $showCountry3['Country_RegionName'] ?>"><?php echo $showCountry3['Country_RegionName'] ?></a></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span><a href="?id=1&country=<?php echo $showCountry4['Country_RegionName'] ?>"><?php echo $showCountry4['Country_RegionName'] ?></a></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span><a href="?id=1&country=<?php echo $showCountry5['Country_RegionName'] ?>"><?php echo $showCountry5['Country_RegionName'] ?></a></span>
                    </td>
                </tr>
            </table>
        </div>

        <div class="hotcity">

            <div class="hotcity_title">
                <span>Hot City</span>
            </div>
            <table>
                <tr>

                    <td>
                        <span><a href="?id=1&city=<?php echo $showCity1['AsciiName'] ?>"><?php echo $showCity1['AsciiName'] ?></a></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span><a href="?id=1&city=<?php echo $showCity2['AsciiName'] ?>"><?php echo $showCity2['AsciiName'] ?></a></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span><a href="?id=1&city=<?php echo $showCity3['AsciiName'] ?>"><?php echo $showCity3['AsciiName'] ?></a></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span><a href="?id=1&city=<?php echo $showCity4['AsciiName'] ?>"><?php echo $showCity4['AsciiName'] ?></a></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span><a href="?id=1&city=<?php echo $showCity5['AsciiName'] ?>"><?php echo $showCity5['AsciiName'] ?></a></span>
                    </td>
                </tr>
            </table>
        </div>

    </div>

    <div class="filter">
        <div class="filter_title">
            <span>Filter</span>
        </div>

        <div class="filter_content">
            <form action="Browse.php?id=1&content=<?php echo $content1 ?>&city=<?php echo $city1 ?>"
                  method="get">
                <label>
                    <div class="filter1">
                        <select name="content1">
                            <option selected value="">Filter by Content</option>
                            <option value="City">City</option>
                            <option value="Animal">Animal</option>
                            <option value="Building">Building</option>
                            <option value="People">People</option>
                            <option value="Scenery">Scenery</option>
                        </select>
                    </div>
                    <div class="filter2">
                        <select id="country" onchange="getCity()">
                            <option value="">Filter by Country</option>

                            <script type="text/javascript">
                                for (let i = 0; i < provinceArr.length; i++) {
                                    document.write("<option value='" + provinceArr[i] + "'>" + provinceArr[i] + "</option>");
                                }
                            </script>

                        </select>
                    </div>

                    <div class="filter3">
                        <select name="city1" id="city">
                            <option value="">Filter by City</option>

                            <script>
                                //当省份的选择发生变化时调用 该方法   将市县加载到下拉选择框
                                function getCity() {
                                    //1.获取省份选择框的对象
                                    const provincesobj = document.getElementById("country");

                                    //2.获取市县选择框的对象
                                    const cityobj = document.getElementById("city");
                                    //3.获取被选择的省份的索引
                                    const index = provincesobj.selectedIndex;
                                    //alert(provincesobj[index].value+","+provincesobj[index].text);  //0 china
                                    //4.通过省份的索引获取它的value值，value值也是它在数组的索引值
                                    //  const value = provincesobj[index].value; //china

                                    var value;
                                    if (cityArr[0].indexOf(provincesobj[index].value) === 0) {
                                        value = 0;
                                    } else if (cityArr[1].indexOf(provincesobj[index].value) === 0) {
                                        value = 1;
                                    } else if (cityArr[2].indexOf(provincesobj[index].value) === 0) {
                                        value = 2;
                                    } else if (cityArr[3].indexOf(provincesobj[index].value) === 0) {
                                        value = 3
                                    }
                                    ;

                                    //5.获取对应省份的市县数组
                                    const cityName = cityArr[value];

                                    //6.将下拉框清楚索引为0之后的，只保留第一个
                                    cityobj.length = 1;
                                    //通过循环遍历市县元素给下拉框赋值
                                    for (let i = 1; i < cityArr[value].length; i++) {
                                        cityobj.options[cityobj.options.length] = new Option(cityName[i], cityName[i]);
                                        console.log(cityName[i], i)
                                    }
                                }
                            </script>
                        </select>
                    </div>
                </label>
                <input type="submit" value="Filter" class="input_filter"">
            </form>
        </div>
        <?php
        foreach ($array as $key => $values) {
            $key = $key + 1;
            $box_num = '<div class=box' . $key . '>';
            echo $box_num;
            echo '<div class="image_box">';
            $href = '<a href="Details.php?ImageID=' . $values->imageid . '">';
            echo $href;
            $img = '<img src="../../large/' . $values->path . '">';
            echo $img;
            echo ' </a>';
            echo '</div>';
            echo '</div>';
        }
        ?>

    </div>
    <div id="navDiv" class="page">
        <span>共<?php echo $allNum ?>条记录</span>
        <span>共计<?php echo $endPage ?>页</span>
        <a class="page_first"
           href="Browse.php?pageNum=1&keywords=<?php echo str_key ?>&content=<?php echo $content ?>&country=<?php echo $country ?>&city=<?php echo $city ?>&city1=<?php echo $city1 ?>&content1=<?php echo $content1 ?>">首页</a>
        <a class="page_prev"
           href="Browse.php?pageNum=<?php echo $pageNum == 1 ? 1 : ($pageNum - 1) ?>&keywords=<?php echo str_key ?>&content=<?php echo $content ?>&country=<?php echo $country ?>&city=<?php echo $city ?>&city1=<?php echo $city1 ?>&content1=<?php echo $content1 ?>">上一页</a>
        <?php
        echo '<a class="a" class="page_current" href="Browse.php?pageNum=1&keywords=' . str_key . '&content=' . str_content . '&country=' . str_country . '&city=' . str_city . '&city1=' . str_city1 . '&content1=' . str_content1 . '">1</a> ';

        for ($i = 2; $i <= $endPage; $i++) {
            echo '<a class="a" class="page_other" href="Browse.php?pageNum=' . $i . '&keywords=' . str_key . '&content=' . str_content . '&country=' . str_country . '&city=' . str_city . '&city1=' . str_city1 . '&content1=' . str_content1 . '">' . $i . '</a> ';
        }
        ?>
        <a class="page_next"
           href="Browse.php?pageNum=<?php echo $pageNum == $endPage ? $endPage : ($pageNum + 1) ?>&keywords=<?php echo str_key ?>&content=<?php echo $content ?>&country=<?php echo $country ?>&city=<?php echo $city ?>&city1=<?php echo $city1 ?>&content1=<?php echo $content1 ?> ">下一页</a>
        <a class="page_last"
           href="Browse.php?pageNum=<?php echo $endPage ?>&keywords=<?php echo str_key ?>&content=<?php echo $content ?>&country=<?php echo $country ?>&city=<?php echo $city ?>&city1=<?php echo $city1 ?>&content1=<?php echo $content1 ?>">尾页</a>
    </div>

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