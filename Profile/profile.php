<?php
    $userinfo = getUserInfo($LoginUserID,$CONNECTION);
 ?>
<div class="body_section">

    <div class="profile_picture">
        <img src="<?php echo $site_root.'images/profile-pictures/'.$LoginUserID.'-pp.jpg';?>" class="profile_picture"/>
    </div>

    <ul class="profile_list">
        <li>Name : <?php echo $userinfo['FullName']; ?></li><br />
        <li>Username : <?php echo $userinfo['Username']; ?></li><br />
        <li>Email Address : <?php echo $userinfo['EmailAddress']; ?></li><br />
        <li>Phone Number : <?php echo $userinfo['PhoneNumber']; ?></li><br />
        <li>Address : <?php echo $userinfo['Address']; ?></li><br />
    </ul>
</div>
