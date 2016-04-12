<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/KothaBajar"."/include/database.php";
    if(isset($_POST['submit'])){
        $err_arr = array();
            if(empty($_POST['user_username'])){
                $err_arr['Username'] = 'Username is required';
            }
            if(empty($_POST['user_password'])){
                $err_arr['Password'] = 'Password is required';
            }
            if(empty($_POST['user_firstname'])){
                $err_arr['FirstName'] = 'FirstName is required';
            }
            if(empty($_POST['user_lastname'])){
                $err_arr['LastName'] = 'LastName is required';
            }
            if(empty($_POST['user_phonenumber'])){
                $err_arr['PhoneNumber'] = 'PhoneNumber is required';
            }
            if(empty($_POST['user_email'])){
                $err_arr['Email'] = 'Email is required';
            }
            if(empty($_POST['user_address'])){
                $err_arr['Address'] = 'Address Field is required';
            }

        // If no error (not filled required field! then add user)
        if(empty($err_arr)){
            //if user is valid to add (username isnot already taken) then add to database
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
        }else{
            printMessage('Please provide all the information to signup, All the field are required !');
        }
    }

    if(isset($_POST['submit_edit'])){
        $err_arr = array();
            if(empty($_POST['user_firstname'])){
                $err_arr['FirstName'] = 'FirstName is required';
            }
            if(empty($_POST['user_lastname'])){
                $err_arr['LastName'] = 'LastName is required';
            }
            if(empty($_POST['user_phonenumber'])){
                $err_arr['PhoneNumber'] = 'PhoneNumber is required';
            }
            if(empty($_POST['user_email'])){
                $err_arr['Email'] = 'Email is required';
            }
            if(empty($_POST['user_address'])){
                $err_arr['Address'] = 'Address Field is required';
            }

            if(empty($err_arr)){
                $userinfo_update = array('UserID'=>$_COOKIE['user'],
                                         'FirstName'=>$_POST['user_firstname'],
                                         'MiddleName'=>$_POST['user_middlename'],
                                         'LastName'=>$_POST['user_lastname'],
                                         'Email'=>$_POST['user_email'],
                                         'Address'=>$_POST['user_address'],
                                         'PhoneNumber'=>$_POST['user_phonenumber'],
                                         'District'=>getDistrictIndex($_POST['user_district'],$district_name_list));
                if(updateUserInfo($userinfo_update, $CONNECTION)){
                    printMessage("Information Updated !");
                }else {
                    printMessage("Cannot Update Information !");
                }
            }else{
                printMessage("You have to provide all the Information required below");
            }
    }

    if(isset($_GET['msg'])){
        $userinfo_edit = getUserInfo($_COOKIE['user'],$CONNECTION);
        if(!isset($_POST['submit_edit'])){
            if(strcmp($_GET['msg'],'edit_profile') == 0){
                $_POST['user_firstname'] = $userinfo_edit['FirstName'];
                $_POST['user_lastname'] = $userinfo_edit['LastName'];
                $_POST['user_middlename'] = $userinfo_edit['MiddleName'];
                $_POST['user_phonenumber'] = $userinfo_edit['PhoneNumber'];
                $_POST['user_email'] = $userinfo_edit['EmailAddress'];
                $_POST['user_address'] = $userinfo_edit['Address'];
                $_POST['user_district'] = $district_name_list[$userinfo_edit['District']];
            }
        }

    }
 ?>

<div>
    <div class="signup_form">
        <?php
            if(isset($_GET['msg']))
                echo "<p style='color:#246;'>Edit Profile</p>";
            else
                echo "<p style='color:#246;'>Signup Form</p>";
        ?>
        <form method="post">
            <center>
                <table border="0px">
                    <tr>
                        <td>Profile Picture</td>
                        <td><input type="file" name="user_profile_picture"/>
                            <td><?php

                             ?></td>
                    </tr>
                    <tr>
                        <?php
                        if(isset($_GET['msg'])){
                            echo "<td>UserName </td><td>".$userinfo_edit['Username']."</td>";
                        }else {
                            echo "<td>UserName</td><td><input type='text' name='user_username' /></td>";
                            if(isset($err_arr['Username']))
                                echo $err_arr['Username'];
                        }
                         ?>
                    </tr>
                    <?php
                        if(!isset($_GET['msg'])){
                            echo "<tr><td>Password</td><td><input type='password' name='user_password'/></td>";
                            echo "<td class='error_text'>";
                            if(isset($err_arr['Password']))
                                echo $err_arr['Password'];
                            echo "</td></tr>";
                        }
                    ?>
                    <tr>
                        <td>FullName</td><td><input type="text" name="user_firstname"
                            <?php if(isset($_POST['user_firstname'])) echo "value='".$_POST['user_firstname']."'"; ?> /></td>
                        <td><input type="text" name="user_middlename"
                            <?php if(isset($_POST['user_middlename'])) echo "value='".$_POST['user_middlename']."'"; ?> /></td>
                            <td><input type="text" name="user_lastname"
                            <?php if(isset($_POST['user_lastname'])) echo "value='".$_POST['user_lastname']."'"; ?> /></td>
                        <td class="error_text"><?php
                            if(isset($err_arr['FirstName']) and isset($err_arr['LastName'])){
                                echo "FistName/LastName both are required";
                            }elseif(isset($err_arr['FirstName'])){
                                echo "FistName is required";
                            }elseif(isset($err_arr['LastName'])){
                                echo "LastName is required";
                            }
                         ?></td>
                    </tr>
                    <tr>
                        <td>PhoneNumber</td><td><input type="text" name="user_phonenumber"
                            <?php if(isset($_POST['user_phonenumber'])) echo "value='".$_POST['user_phonenumber']."'"; ?> /></td>
                        <td class="error_text"><?php
                            if(isset($err_arr['PhoneNumber']))
                                echo $err_arr['PhoneNumber'];
                         ?></td>
                    </tr>
                    <tr>
                        <td>Email Address</td><td><input type="text" name="user_email"
                            <?php if(isset($_POST['user_email'])) echo "value='".$_POST['user_email']."'"; ?> /></td>
                        <td class="error_text"><?php
                            if(isset($err_arr['Email']))
                                echo $err_arr['Email'];
                         ?></td>
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
                        <td class="error_text"><?php
                            if(isset($err_arr['Address']))
                                echo $err_arr['Address'];
                         ?></td>
                    </tr>
                    <tr>
                        <td></td><td><input type="submit" <?php
                            if(isset($_GET['msg']))
                                    echo "name='submit_edit' value='Save'";
                            else{
                                echo "name='submit' value='Signup'";
                            }
                         ?>" /></td>
                    </tr>
                </table>
            </center>
        </form>
        <a style="text-align:center" href="<?php echo $domain_name.'/Login/' ?>">Login</a>
    </div>
</div>
