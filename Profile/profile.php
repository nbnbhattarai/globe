<?php
    $uid = -1;
    if(isset($_GET['id'])){
        $uid = $_GET['id'];
    }else{
        if(isset($_COOKIE['user']))
            $uid = $_COOKIE['user'];
    }
    $userinfo = getUserInfo($uid,$CONNECTION);

    if(isset($_GET['msg'])){
        // if edit is sent through get, then edit profile
        if(strcmp($_GET['msg'],'edit') == 0){

        }
    }
 ?>

<div class="body_section">

    <center>
    <table>
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
        <tr>
            <td>District</td><td><?php echo $district_name_list[$userinfo['District']]; ?></td>
        </tr>
    </table>
</center>
    <?php
    if($userinfo){
        if($_COOKIE['user'] == $userinfo['UserID']){
            /*
        echo "<form method='get'>
            <input type='submit' name='msg' value='edit' />
        </form>";
        */
        echo "<a href='http://".$_SERVER['SERVER_NAME']."/KothaBajar/Signup/?msg=edit_profile'>Edit</a>";
        }
    }
    ?>
<center>
    <table>
        <tr>
        </tr>
    </table>
</center>

</div>
<center>
    <h4><u>Uploaded Rooms</u></h4><br />
    <center>
    <?php
        $rooms = getRoomsOfUser($_COOKIE['user'],$CONNECTION);
        if($rooms != false){
            $count = 1;
            if(!empty($rooms)){
                echo "<table><tr><td>SN</td><td>Type</td><td>Name</td><td>Submitted Date</td><td>Taken</td></tr>";
            foreach ($rooms as $room) {
                    if($count%2 == 0)
                        echo "<tr style='background-color:#891'>";

                    echo "<td>".$count."</td>";

                    switch ($room['Type']) {
                        case 'A':
                            echo "<td>Apartment</td>";
                            break;
                        case 'H':
                            echo "<td>House</td>";
                            break;
                        case 'R':
                            echo "<td>Room</td>";
                            break;
                        default:
                            echo "<td>Unspecified</td>";
                            break;
                    }

                    echo "<td><a href='http://".$_SERVER['SERVER_NAME']."/KothaBajar/Info?id=".$room['KothaID']."'>".$room['Name']."</a></td>";
                    echo "<td>".$room['CreateDate']."</td>";
                    if($room['Taken'] == 1)
                        echo "<td>YES</td>";
                    else
                        echo "<td>NO</td>";
                echo "</tr>";
                $count++;
            }
            if(!empty($rooms))
                echo "</table>";
            }
        }
     ?>
</center>
<div>
    <br />
</div>
