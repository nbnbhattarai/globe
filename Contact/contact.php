<?php
    if(isset($_POST['submit_email'])){
        $userid = '-1';
        $err_arr = array();
        if(isset($_POST['email_address'])){
            $useremail = $_POST['email_address'];
            if(empty($useremail))
                $err_arr['Email'] = 'Email Address is required !';
        }
        if(empty($_POST['emailText'])){
            $err_arr['EmailText'] = 'Write Something.';
            printMessage("Write something !!");
        }

        if(isset($_COOKIE['user'])){
            $userid = $_COOKIE['user'];
            $userinfo_con = getUserInfo($_COOKIE['user'],$CONNECTION);
            $useremail = $userinfo_con['EmailAddress'];
        }
        $emailtext = $_POST['emailText'];
        $e_from = array('UserID'=>$userid,
                        'UserEmail'=>$useremail,
                        'EmailText'=>$emailtext);
        if(empty($err_arr)){
            if(sendMail ($e_from, $CONNECTION)){
                printMessage("Email Sent !!");
            }
        }
    }
 ?>
<center>
<div class="body_section">
    <form method="post">
    <?php
        if(!isset($_COOKIE['user'])){
            echo "Email : <input type='text' name='email_address' />";
            if(isset($err_arr['Email']))
                echo $err_arr['Email'];
            echo "<br />";
        }else{
            $userinfo_con = getUserInfo($_COOKIE['user'],$CONNECTION);
            echo "Username : ".$userinfo_con['Username']."<br />";
        }
     ?>
     <textarea name="emailText" rows="15" cols="80"></textarea>
     <br /><br />
     <input type="submit" value="Send Email" name="submit_email"/>
 </form>
</div>
</center>
