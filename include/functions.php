<?php

function printMessage ($message){
    echo "<p style='width=100%;background-color:#000;color:#fff;text-align:center;'>".$message."</p>";
}

function alert($message){
    echo "<script>alert(".$message.");</script>";
}

    function getUserFullName($userid){
        $qry = "SELECT FirstName,MiddleName,LastName from Users where ID='".$userid."'";
        $result = mysqli_query($CONNECTION,$userid);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row['FirstName']." ".$row['MiddleName']." ".$row['LastName'];
    }

    function getUserInfo($userid,$CONN){
        $qry = "SELECT * from Users where ID='".$userid."'";
        $result = mysqli_query($CONN,$qry);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return array('FirstName'=>$row['FirstName'],
                     'MiddleName'=>$row['MiddleName'],
                     'LastName'=>$row['LastName'],
                     'FullName'=>$row['FirstName']." ".$row['MiddleName']." ".$row['LastName'],
                     'Username'=>$row['Username'],
                     'EmailAddress'=>$row['EmailAddress'],
                     'PhoneNumber'=>$row['PhoneNumber'],
                     'Address'=>$row['Address']);
    }

    function getDistrictIndex($dname,$dnl){
        for($i = 0; $i < 75; $i++){
            if (strcmp($dname,$dnl[$i]) == 0)
                return $i;
        }
        return -1;
    }

    function insertRoomDetainInDB($roominfo, $CONN){

        $qry = "INSERT into kotha_info values ('',".
                "'".$roominfo['Type']."',".
                "'".$roominfo['Name']."',".
                "'".$roominfo['Address']."',".
                "'".$roominfo['District']."',".
                "'".$roominfo['GharNumber']."',".
                "'".$roominfo['Rent']."',".
                "'".$roominfo['RentNegotiable']."',".
                "'".$roominfo['PhoneNumber']."',".
                "'".$roominfo['Water']."',".
                "'".$roominfo['WaterBill']."',".
                "'".$roominfo['Electricity']."',".
                "'".$roominfo['ElectricityBill']."',".
                "'".$roominfo['Internet']."',".
                "'".$roominfo['InternetBill']."',".
                "'".$roominfo['TransportationDistance']."',".
                "'".$roominfo['Floor']."',".
                "'".$roominfo['GharMuliId']."',".
                "'".$roominfo['Discription']."','".time()."')";
        echo '<br/>'.$qry;

        $result = mysqli_query($CONN, $qry) or die(printMessage('Cannot post room information'));
        return true;
    }
?>
