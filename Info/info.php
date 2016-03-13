<?php
/**
    This prints out information about room/apartment or house
**/
    if(isset($_GET['id'])){
        $roominfo = getRoomInfo($_GET['id'],$CONNECTION);
        $ownerinfo = getUserInfo($roominfo['GharMuliId'],$CONNECTION);
    }else{
        printMessage('Nothing To show');
        die();
    }
 ?>

<table>
    <center>
        <tr>
            <td>Type</td>
            <td><?php switch ($roominfo['Type']) {
                case 'A':
                    echo "Apartment";
                    break;
                case 'R':
                    echo "Room";
                    break;
                case 'H':
                    echo "House";
                    break;
                default:
                    echo "Not Specified";
                    break;
            } ?>
        </td>
        </tr>
        <tr>
            <td>Name</td><td><?php echo $roominfo['Name']; ?></td>
        </tr>
        <tr>
            <td>Address</td><td><?php echo $roominfo['Address']; ?></td>
        </tr>
        <tr>
            <td>District</td><td><?php
                if($roominfo['District'] < 0 || $roominfo['District'] >= 75)
                    echo 'Unspecified';
                else
                    echo $district_name_list[$roominfo['District']];
            ?></td>
        </tr>
        <tr>
            <td>Ghar Number</td><td><?php echo $roominfo['GharNumber']; ?></td>
        </tr>
        <tr>
            <td>Rent</td><td><?php echo $roominfo['Rent'] ?></td>
        </tr>
        <tr>
            <td>RentNegotiable</td>
            <td><?php
                if($roominfo['RentNegotiable'] == 1){
                    echo 'YES';
                }else {
                    echo "NO";
                }
             ?></td>
        </tr>
        <tr>
            <td>PhoneNumber</td><td><?php echo $roominfo['PhoneNumber']; ?></td>
        </tr>
        <tr>
            <td>Water</td><td><?php
            if($roominfo['Water'] == 1){
                echo "YES";
            }else {
                echo "NO";
            }
             ?></td>
        </tr>
        <tr>
            <td>Water Bill</td><td><?php
            if(strcmp($roominfo['WaterBill'],'') == 0){
                echo "INCLUDED IN RENT";
            }else {
                echo $roominfo['WaterBill'];
            }
             ?></td>
        </tr>
        <tr>
            <td>Electricity</td><td><?php
            if($roominfo['Electricity'] == 1){
                echo "YES";
            }else {
                echo "NO";
            }
             ?></td>
        </tr>
        <tr>
            <td>Electricity Bill</td><td><?php
            if(strcmp($roominfo['ElectricityBill'],'') == 0){
                echo "INCLUDED IN RENT";
            }else {
                echo $roominfo['ElectricityBill'];
            }
             ?></td>
        </tr>
        <tr>
            <td>Internet</td><td><?php
            if($roominfo['Internet'] == 1){
                echo "YES";
            }else {
                echo "NO";
            }
             ?></td>
        </tr>
        <tr>
            <td>Internet Bill</td><td><?php
            if(strcmp($roominfo['InternetBill'],'') == 0){
                echo "INCLUDED IN RENT";
            }else {
                echo $roominfo['InternetBill'];
            }
             ?></td>
        </tr>
        <tr>
            <td>TransportationDistance</td><td><?php echo $roominfo['TransportationDistance'].' Km.'; ?></td>
        </tr>
        <tr>
            <td>Floor</td><td><?php echo $roominfo['Floor'] ?></td>
        </tr>
        <tr>
            <td>Discription</td><td><?php echo $roominfo['Discription'] ?></td>
        </tr>
        <tr>
            <td>Taken</td><td><?php
            if($roominfo['Taken'] == 1){
                echo "YES";
            }else {
                echo "NO";
            }
             ?></td>
        </tr>
        <tr>
            <td>Submitted Date</td>
            <td><?php
                $d =  date("d M, Y G:i:s",$roominfo['CreateDate']);
                if($d != false){
                    echo $d;
                }else {
                    echo "Error !!";
                }
             ?></td>
        </tr>
        <?php
            if($roominfo['CreateDate'] != $roominfo['LastUpdate']){
                $d =  date("d M, Y G:i:s",$roominfo['LastUpdate']);
                if($d != false){
                    echo "<tr><td>Last Updated</td><td>".$d." ?></td></tr>";
                }
            }
         ?>
    </center>
</table>

    Owner information
<table>
    <center>
        <tr><td>Full Name</td><td><a href="<?php echo $_SERVER['SERVER_NAME'].'/KothaBajar/Profile/?id='.$roominfo['GharMuliId']; ?>"><?php echo $ownerinfo['FullName'] ?></a></td></tr>
        <tr><td>UserName</td><td><?php echo $ownerinfo['Username'] ?></td></tr>
        <tr><td>Phone Number</td><td><?php echo $ownerinfo['PhoneNumber'] ?></td></tr>
        <tr><td>Email Address</td><td><?php echo $ownerinfo['EmailAddress'] ?></td></tr>
        <tr><td>Address</td><td><?php echo $ownerinfo['Address'] ?></td></tr>
        <tr><td>User Since</td><td><?php
        $d =  date("d M, Y G:i:s",$ownerinfo['CreateDate']);
        if($d != false){
            echo $d;
        }else {
            echo "Error !!";
        }
         ?></td></tr>
    </center>
</table>
