<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../CSS/reset.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Index.css">
</head>
<body>

<div class="header"></div>

<div class="maincontent">

    <div class="content">

        <div class="logo">
            <img src="../../Image/logo.png" alt="logo">
            <h1>LOGIN</h1>
        </div>


        <div class="login">
            <form class="form" action="Login_action.php" method="post">
                <table>
                    <tr>
                        <td>

                            <label>
                                <input placeholder="Username"
                                       name="username" type="text" class="account" required="required" value="<?php
                                echo isset($_COOKIE[""]) ? $_COOKIE[""] : ""; ?>" maxlength="18" size="30px">
                            </label>
                        </td>
                    </tr>
                    <br>
                    <tr>
                        <td>

                            <label>
                                <input placeholder="Password" aria-required="true" autocapitalize="off"
                                       autocorrect="off"
                                       maxlength="18"
                                       name="password" type="password" class="password" value="" size="30px">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>

                            <?php
                            $err = isset($_GET["err"]) ? $_GET["err"] : "";
                            switch ($err) {
                                case 1:

                                    echo "用户名或密码错误！";
                                    break;

                                case 2:
                                    echo "用户名或密码不能为空！";
                                    break;
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>

                            <br>
                            <button type="submit" name="submit" class="bt">LOGIN</button>
                            <br>
                        </td>
                    </tr>

                </table>
            </form>

        </div>


    </div>

    <div class="register">
        <p>no account ? <a href="Register.php">REGISTER</a></p>

    </div>

</div>


<div class="footer">
    <span>Copyright &copy; 2020 SOFT1300002. All rights reserved.</span>
</div>


</body>
</html>