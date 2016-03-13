<?php
    $uid = -1;
    if(isset($_GET['id'])){
        $uid = $_GET['id'];
    }else{
        if(isset($_COOKIE['user']))
            $uid = $_COOKIE['user'];
    }
    $userinfo = getUserInfo($uid,$CONNECTION);
 ?>

<div class="body_section">

    <div class="profile_picture">
        <img src="<?php echo $site_root.'images/profile-pictures/'.$LoginUserID.'-pp.jpg';?>" alt="[profile_picture image]" class="profile_picture"/>
        <input type="file" value="upload profile picture" />
    </div>

    <ul class="profile_list">
        <li>Name : <?php echo $userinfo['FullName']; ?></li><br />
        <li>Username : <?php echo $userinfo['Username']; ?></li><br />
        <li>Email Address : <?php echo $userinfo['EmailAddress']; ?></li><br />
        <li>Phone Number : <?php echo $userinfo['PhoneNumber']; ?></li><br />
        <li>Address : <?php echo $userinfo['Address']; ?></li><br />
    </ul>
    <form method="get">
        <input type="submit" value="Edit" />
    </form>

</div>
