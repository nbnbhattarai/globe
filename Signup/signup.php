<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/KothaBajar"."/include/database.php";
    $err_arr = array();
    if(isset($_POST['user_username'])){
        if(strcmp($_POST['user_username'], ' ') == 0)
            $err_arr.append('Username is required');
    }
    if(isset($_POST['user_password'])){
        if($_POST['user_password'] == ' ')
            $err_arr.append('Password is required');
    }
    if(isset($_POST['user_firstname'])){
        if($_POST['user_firstname'] == ' ')
            $err_arr = array('FirstName is required');
    }
    if(isset($_POST['user_lastname'])){
        if($_POST['user_lastname'] == ' ')
            $err_arr = array('LastName is required');
    }
    if(isset($_POST['user_phonenumber'])){
        if($_POST['user_phonenumber'] == ' ')
            $err_arr = array('PhoneNumber is required');
    }
    if(isset($_POST['user_email'])){
        if($_POST['user_email'] == ' ')
            $err_arr = array('Email is required');
    }
    if(isset($_POST['user_address'])){
        if($_POST['user_username'] == ' ')
            $err_arr = array('Address is required');
    }

        // check whether the $username already exist in database or not
        function isValidUserToAdd ($username, $connection){
            $qry = "SELECT UserID,Username from Users";
            $result = mysqli_query($connection,$qry) or die('Connection broken with database signup[isValidUserToAdd]');

            while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                if(strcmp($row['Username'],$username) == 0){
                    return false;
                }
            }
            return true;
        }

        // add user to database with array of user information $userinfo
        function addUser($userinfo, $connection){

            $qry = "INSERT into Users values ('','".$userinfo['FirstName']."','".
            $userinfo['MiddleName']."','".$userinfo['LastName']."','".$userinfo['Username']."','".
            $userinfo['Email']."','".$userinfo['Password']."','".$userinfo['PhoneNumber']."','".
            $userinfo['Address']."','".$userinfo['District']."','1','".date('Y-n-j G:i:s',time())."','".date('Y-n-j G:i:s',time())."')";

            echo $qry;
            mysqli_query($connection, $qry) or die('User cannot be added');

            return true;
        }

        // is username is valid(doesn't exist in database) then add user
        if(empty($err_arr) and isset($_POST['user_username'])){
            if(isValidUserToAdd($_POST['user_username'],$CONNECTION)){
                $userinfo = array('Username'=>$_POST['user_username'],
                                'Password'=>$_POST['user_password'],
                                'FirstName'=>$_POST['user_firstname'],
                                'MiddleName'=>$_POST['user_middlename'],
                                'LastName'=>$_POST['user_lastname'],
                                'Email'=>$_POST['user_email'],
                                'Address'=>$_POST['user_address'],
                                'PhoneNumber'=>$_POST['user_phonenumber'],
                                'District'=>getDistrictIndex($_POST['user_district'],$district_name_list));

                    if(addUser($userinfo, $CONNECTION)){
                        printMessage('User added successfully !!');
                    }
            }else{
                printMessage('UserName Already exist, choose another username !');
            }
        }
        if(!empty($err_arr)){
            printMessage('Please provide all the information to signup, All the field are required !');
        }
 ?>

<div>
    <div class="signup_form">
        <p style="color:#246;">Signup Form</p>
        <form method="post">
            <center>
                <table border="0px">
                    <tr>
                        <td>Profile Picture</td>
                        <td><input type="file" name="user_profile_picture"/>
                    </tr>
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
                            <td>
                                <select name="user_district">
                                    <option selected="selected">(choose one)</option>
                                    <?php
                                        for($i=0; $i < 75; $i++){
                                            if(isset($_POST['user_district'])){
                                                if($i == getDistrictIndex($_POST['user_district'],$district_name_list))
                                                    echo "<option selected='selected'>".$district_name_list[$i]."</option>";
                                                else
                                                    echo "<option>".$district_name_list[$i]."</option>";
                                            }
                                            else
                                                echo "<option>".$district_name_list[$i]."</option>";
                                        }
                                    ?>
                                </select>
                            </td>
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
