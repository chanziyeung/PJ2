<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../CSS/reset.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Register.css">
</head>
<body>

<div class="header"></div>
<div class="maincontent">


    <div class="content">

        <div class="logo">
            <img src="../../Image/logo.png" alt="logo">
            <h1>REGISTER</h1>
        </div>

        <div class="login">
            <form class="form" action="Register_action.php" method="post">
                <table>
                    <tr>
                        <td>
                            <label>
                                <input placeholder="Username"
                                       name="username" type="text" class="account" value="" required="required"
                                       maxlength="18" size="22px">
                            </label>

                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>
                                <input placeholder="Email"
                                       name="email" type="text" class="account" value="" required="required"
                                       maxlength="18" size="22px">
                            </label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>
                                <input placeholder="Password" aria-required="true" autocapitalize="off"
                                       autocorrect="off" maxlength="18"
                                       name="password" type="password" class="account" value="" required="required"
                                       size="22px">
                            </label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>
                                <input placeholder="Confirm Password"
                                       name="re_password" type="password" class="account" value="" required="required"
                                       maxlength="18" size="22px">
                            </label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <?php
                            $err = isset($_GET["err"]) ? $_GET["err"] : "";
                            switch ($err) {
                                case 1:
                                    echo "用户名已存在！";
                                    break;

                                case 2:
                                    echo "密码与重复密码不一致！";
                                    break;

                                case 3:
                                    echo "注册成功！";
                                    break;
                                case 4:
                                    echo"用户名只允许3位以上字母和数字!";
                                    break;
                                case 5:
                                    echo "非法邮箱格式";
                                    break;
                                case 6:
                                    echo "密码6位以上的数字字母组成";
                                    break;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                    <button type="submit" class="bt">REGISTER</a></button>
                        </td>
                    </tr>

                </table>
            </form>
        </div>


    </div>

    <div class="register">
        <p>Do you have an account? <a href=Login.php>LOGIN</a></p>
    </div>

</div>
<div class="footer">
    <span>Copyright &copy; 2020 SOFT1300002. All rights reserved.</span>
</div>
</body>
