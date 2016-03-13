<?php
    if (isset($_POST['login_username']) || isset($_POST['login_password'])){
            if(($arr = isValidUserToLogin($_POST['login_username'],$_POST['login_password'],$CONNECTION)) == false){
                printMessage("Username and Password didn't matched. Try again !");
            }else{
                setcookie('user',$arr['UserID'],time() + (86400 * 30), "/");
                $logined = true;
                $_SESSION['logined'] = true;
                $LoginUserName = $arr['Username'];
                $_SESSION['LoginUserName'] = $arr['Username'];
                $LoginUserID = $arr['UserID'];
                $_SESSION['LoginUserID'] = $arr['UserID'];
                unset($_POST['login_username']);
                unset($_POST['login_password']);
                unset($_POST['login_submit']);
                header('../');
                //printMessage("Logined Successfully with username :".$arr['Username']);
            }
    }
 ?>

<div class="body_section">
    <h4><u style="color:#365">Login</u></h4>
    <div class="login_form">
        <form method="post">
            <input type="text" name="login_username" value="<?php
            if(isset($_POST['login_username'])) echo $_POST['login_username'];
            else echo 'username';?>"/><br />
            <input type="password" name="login_password" value="<?php
            if(isset($_POST['login_password'])) echo $_POST['login_password'];
            else echo 'password'
             ?>"/><br />
            <input type="submit" name="login_submit" value="Login" /><br />
        </form>
    </div>
    <a style="align:center" href="<?php echo $domain_name.'/Signup/'?>">Signup</a>
</div>
