<?php
    require_once '/srv/http/KothaBajar/include/database.php';
    if(isset($_POST['user_username'])){
        if(strcmp($_POST['user_email'],' ') == 0 ){
            printMessage('Email Address is Necessery');
            die('');
        }
        function isValidUserToAdd ($username, $connection){
            $qry = "SELECT ID,Username from Users";
            $result = mysqli_query($connection,$qry) or die('Connection broken with database signup[isValidUserToAdd]');

            while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                if(strcmp($row['Username'],$username) == 0){
                    return false;
                }
            }
            return true;
        }

        function addUser($userinfo, $connection){

            $qry = "INSERT into Users values ('','".$userinfo['FirstName']."','".
            $userinfo['MiddleName']."','".$userinfo['LastName']."','".$userinfo['Username']."','".
            $userinfo['Email']."','".$userinfo['Password']."','".$userinfo['PhoneNumber']."','".
            $userinfo['Address']."')";

            mysqli_query($connection, $qry) or die('User cannot be added');

            return true;
        }

        if(isValidUserToAdd($_POST['user_username'],$CONNECTION)){
            $userinfo = array('Username'=>$_POST['user_username'],
                            'Password'=>$_POST['user_password'],
                            'FirstName'=>$_POST['user_firstname'],
                            'MiddleName'=>$_POST['user_middlename'],
                            'LastName'=>$_POST['user_lastname'],
                            'Email'=>$_POST['user_email'],
                            'Address'=>$_POST['user_address'],
                            'PhoneNumber'=>$_POST['user_phonenumber']);

                if(addUser($userinfo, $CONNECTION)){
                    printMessage('User added successfully !!');
                }
        }else{
            printMessage('Username already exist, use another username!');
        }
    }
 ?>
<div>
    <div class="signup_form">
        <p style="color:#246;">Signup Form</p>
        <form method="post">
            <center>
                <table border="0px">
                    <tr>
                        <td>UserName</td><td><input type="text" name="user_username"
                           <?php if(isset($_POST['user_username'])) echo "value='".$_POST['user_username']."'"; ?> /></td>
                    </tr>
                    <tr>
                        <td>Password</td><td><input type="password" name="user_password"/></td>
                    </tr>
                    <tr>
                        <td>FullName</td><td><input type="text" name="user_firstname"
                            <?php if(isset($_POST['user_firstname'])) echo "value='".$_POST['user_firstname']."'"; ?> /></td>
                        <td><input type="text" name="user_middlename"
                            <?php if(isset($_POST['user_middlename'])) echo "value='".$_POST['user_middlename']."'"; ?> /></td>
                            <td><input type="text" name="user_lastname"
                            <?php if(isset($_POST['user_lastname'])) echo "value='".$_POST['user_lastname']."'"; ?> /></td>
                    </tr>
                    <tr>
                        <td>PhoneNumber</td><td><input type="text" name="user_phonenumber"
                            <?php if(isset($_POST['user_phonenumber'])) echo "value='".$_POST['user_phonenumber']."'"; ?> /></td>
                    </tr>
                    <tr>
                        <td>Email Address</td><td><input type="text" name="user_email"
                            <?php if(isset($_POST['user_email'])) echo "value='".$_POST['user_email']."'"; ?> /></td>
                    </tr>
                    <tr>
                        <td>Address</td><td><input type="text" name="user_address"
                            <?php if(isset($_POST['user_address'])) echo "value='".$_POST['user_address']."'"; ?> /></td>
                    </tr>
                    <tr>
                        <td></td><td><input type="submit" name="submit" value="Signup" /></td>
                    </tr>
                </table>
            </center>
        </form>
        <a style="text-align:center" href="<?php echo $domain_name.'/Login/' ?>">Login</a>
    </div>
</div>
