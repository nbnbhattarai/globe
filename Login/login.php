<div class="body_section">
    <h4><u style="color:#365">Login</u></h4>
    <div class="login_form">
        <form method="post">
            <input type="text" name="login_username" value="username"/><br />
            <input type="password" name="login_password" value="password" /><br />
            <input type="submit" name="login_submit" value="Login" /><br />
        </form>
    </div>
    <a style="align:center" href="<?php echo $domain_name.'/Signup/'?>">Signup</a>
</div>
<?php
    if (isset($_POST['login_username']) || isset($_POST['login_password'])){
            if(($arr = isValidUserToLogin($_POST['login_username'],$_POST['login_password'],$CONNECTION)) == false){
                printMessage("Username and Password didn't matched. Try again !");
            }else{
                printMessage("Logined Successfully with username :".$arr['Username']);
                $logined = true;
                $_SESSION['logined'] = true;
                $LoginUserName = $arr['Username'];
                $_SESSION['LoginUserName'] = $arr['Username'];
                $LoginUserID = $arr['UserID'];
                $_SESSION['LoginUserID'] = $arr['UserID'];
            }
    }
 ?>
