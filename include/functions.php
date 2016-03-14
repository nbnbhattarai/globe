<?php

    require_once "global.php";
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
        $qry = "SELECT * from Users where UserID='".$userid."'";
        $result = mysqli_query($CONN,$qry) or die('mysql query error..');
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if(empty($row))
            return false;
        return array('FirstName'=>$row['FirstName'],
                     'MiddleName'=>$row['MiddleName'],
                     'LastName'=>$row['LastName'],
                     'FullName'=>$row['FirstName']." ".$row['MiddleName']." ".$row['LastName'],
                     'Username'=>$row['Username'],
                     'UserID'=>$userid,
                     'EmailAddress'=>$row['EmailAddress'],
                     'PhoneNumber'=>$row['PhoneNumber'],
                     'Address'=>$row['Address'],
                     'District'=>$row['District'],
                     'Active'=>$row['Active'],
                     'CreateDate'=>$row['CreateDate'],
                     'LastUpdate'=>$row['LastUpdate'],
                 );
    }
    function getRoomInfo ($roomid, $CONN){
        $qry = "SELECT * FROM KothaInfo where KothaID='".$roomid."'";
        $result = mysqli_query($CONN, $qry) or die('Mysql query error...');
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if(empty($row))
            return false;
        return array(
                     'Type' => $row['Type'],
                     'Name' => $row['Name'],
                     'Address' => $row['Address'],
                     'District' => $row['District'],
                     'GharNumber' => $row['GharNumber'],
                     'Rent' => $row['Rent'],
                     'RentNegotiable' => $row['RentNegotiable'],
                     'PhoneNumber' => $row['PhoneNumber'],
                     'Water' => $row['Water'],
                     'WaterBill' => $row['WaterBill'],
                     'Electricity' => $row['Electricity'],
                     'ElectricityBill' => $row['ElectricityBill'],
                     'Internet' => $row['Internet'],
                     'InternetBill' => $row['InternetBill'],
                     'TransportationDistance' => $row['TransportationDistance'],
                     'Floor' => $row['Floor'],
                     'GharMuliId' => $row['GharMuliId'],
                     'Discription' => $row['Discription'],
                     'Taken' => $row['Taken'],
                     'CreateDate' => $row['CreateDate'],
                     'LastUpdate' => $row['LastUpdate']
                 );
    }

    function getDistrictIndex($dname,$dnl){
        for($i = 0; $i < 75; $i++){
            if (strcmp($dname,$dnl[$i]) == 0)
                return $i;
        }
        return -1;
    }

    function insertRoomDetainInDB($roominfo, $CONN){

        $qry = "INSERT into KothaInfo values ('',".
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
                "'".$roominfo['Discription']."','0','".date('Y-n-j G:i:s',time())."','".date('Y-n-j G:i:s',time())."')";
        echo $qry;
        $result = mysqli_query($CONN, $qry) or die(printMessage('Cannot post room information'));
        return true;
    }


    function getRoomsOfUser ($userid, $CONN){
        $qry = "SELECT * FROM KothaInfo WHERE GharMuliId='".$userid."'";
        $result = mysqli_query($CONN,$qry) or die('SQL query error ....');
        $num_rows = mysqli_num_rows ($result);
        if($num_rows > 0){
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $rooms[] = $row;
            }
            return $rooms;
        }else {
            return false;
        }
    }

    function getSearchResult ($locationText, $category, $rent_category,$rent_values, $district_name, $ordering, $dnl, $CONN){
        $categoryWhereText ="";
        //  House Room Apartment
        switch ($category) {
            case 0:
                $categoryWhereText = "Type='*'";
                break;
            case 1:
                $categoryWhereText = "Type='A'";
                break;
            case 2:
                $categoryWhereText = "Type='R'";
                break;
            case 3:
                $categoryWhereText = "(Type='A' or Type='R')";
                break;
            case 4:
                $categoryWhereText = "Type='H'";
                break;
            case 5:
                $categoryWhereText = "(Type='H' or Type='A')";
                break;
            case 6:
                $categoryWhereText = "(Type='H' or Type='R')";
                break;
            case 7:
                $categoryWhereText = "(Type='H' or Type='R' or Type='A')";
                break;
            default:
                $categoryText = '(TRUE)';
                break;
        }

        // ABOVE BELOW
        // VALUES (BELOW#0 ABOVE)
        $rentWhereText = "";
        switch ($rent_category) {
            case 0:
                $rentWhereText = "rent='*'";
                break;
            case 1:
                $rentWhereText = "rent<'".$rent_values[0]."'";
                break;
            case 2:
                $rentWhereText = "rent>'".$rent_values[1]."'";
                break;
            case 3:
                $rentWhereText = "(rent<'".$rent_values[0]."' and rent>'".$rent_values[1]."')";
                break;
            default:
                $rentWhereText = "(TRUE)";
                break;
        }

        if(getDistrictIndex($district_name,$dnl) == -1)
            $districtWhereText = "(TRUE)";
        else
            $districtWhereText = "District='".getDistrictIndex($district_name,$dnl)."'";

        $qry = "select KothaID,Type,Name,Rent,CreateDate,District from KothaInfo where ".$categoryWhereText." and ".$rentWhereText." and ".$districtWhereText." order by ".$ordering['order_by']." ".$ordering['order_asc_desc'].";";
        echo $qry;
        $result = mysqli_query($CONN,$qry) or die('Mysql query error .....');
        $num_result = mysqli_num_rows($result);
        if($num_result > 0){
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $rooms[] = $row;
            }
            return $rooms;
        }else {
            return false;
        }
    }
?>
