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

    <table>
        <center>
        <tr>
            <td>Profile Picture</td>
            <td><img src="<?php echo $site_root.'images/profile-pictures/'.$LoginUserID.'-pp.jpg';?>" alt="[profile_picture image]" class="profile_picture"/></td>
        </tr>
        <tr>
            <td>Name</td>
            <td><?php echo $userinfo['FullName']; ?></td>
        </tr>
        <tr>
            <td>Username</td>
            <td><?php echo $userinfo['Username']; ?></td>
        </tr>
        <tr>
            <td>Email Address</td><td><?php echo $userinfo['EmailAddress']; ?></td>
        </tr>
        <tr>
            <td>Phone Number</td><td><?php echo $userinfo['PhoneNumber']; ?></td>
        </tr>
        <tr>
            <td>Address</td><td><?php echo $userinfo['Address']; ?></td>
        </tr>
    </center>
    </table>
    <form method="get">
        <input type="submit" value="Edit" />
    </form>
    <table><center>
        <tr>
        </tr>
    </center></table>

</div>
