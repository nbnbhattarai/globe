<?php
    if(isset($_POST['room_type']) && isset($_POST['room_name']) && isset($_POST['room_address'])){
        $WaterBool = true;
        $RentNegotiableBool = true;
        $TypeChar = 'A';
        $DistrictInt = 1;
        $ElectricityBool = true;
        $InternetBool = true;
        if(strcmp($_POST['rent_negotiable'],'Yes') == 0){
            $RentNegotiableBool = true;
        }else{
            $RentNegotiableBool = false;
        }

        if(strcmp($_POST['water'],"Yes") == 0){
            $WaterBool = true;
        }else{
            $WaterBool = false;
        }

        if(strcmp($_POST['electricity'],"Yes") == 0){
            $ElectricityBool = true;
        }else{
            $ElectricityBool = false;
        }

        if(strcmp($_POST['internet'],"Yes") == 0){
            $InternetBool = true;
        }else{
            $InternetBool = false;
        }

        switch ($_POST['room_type']) {
            case 'Apartment':
                $TypeChar = 'A';
                break;
            case 'Room':
                $TypeChar = 'R';
                break;
            case 'House':
                $TypeChar = 'H';
                break;
            default:
                $TypeChar = 'E';
                break;
        }
        $DistrictInt = getDistrictIndex($_POST['room_district'],$district_name_list);

        $roominfo = array(
            'Type' => $TypeChar,
            'Name' => $_POST['room_name'],
            'Address' => $_POST['room_address'],
            'District' => $DistrictInt,
            'GharNumber' => $_POST['gharnumber'],
            'Rent' => $_POST['rent'],
            'RentNegotiable' => $RentNegotiableBool,
            'PhoneNumber' => $_POST['phone_number'],
            'Water' => $WaterBool,
            'WaterBill' => $_POST['water_bill'],
            'Electricity' => $ElectricityBool,
            'ElectricityBill' => $_POST['electricity_bill'],
            'Internet' => $InternetBool,
            'InternetBill' => $_POST['internet_bill'],
            'TransportationDistance' => $_POST['transportation_distance'],
            'Floor' => $_POST['floor'],
            'GharMuliId' => $_SESSION['LoginUserID'],
            'Discription' => $_POST['other_info']
        );
        echo "<pre>";
        print_r ($roominfo);
        echo "</pre>";

        if(insertRoomDetainInDB($roominfo,$CONNECTION)){
            printMessage('Room info added to the database !, Thank you !');
        }else{
            printMessage('Room info cannot be added to the database !, Try Again Later !');
        }
    }
 ?>

<div style="text-align:center">
    <br/>
        <div class="submit_form">
            <form method="post">
                <center>
                <table border="0px">
                    <tr>
                        <td>Type</td>
                        <td>
                            <select name="room_type">
                                <option selected="selected">(choose one)</option>
                                <option>Apartment</option>
                                <option>Room</option>
                                <option>House</option>
                        </td>
                    </tr>
                    <tr>
                        <td>Name</td><td><input type="text" name="room_name" maxlength="50"
                        <?php if($logined == true) echo 'value='.$Username."'s submition"; ?>/></td>
                    </tr>
                    <tr>
                        <td>Address</td><td> <input type="text" name="room_address" maxlength="100" /></td>
                        <td>District</td><td>
                            <select name="room_district">
                                <option selected="selected">(choose one)</option>
                                <?php
                                    for($i=0; $i < 75; $i++)
                                        echo "<option>".$district_name_list[$i]."</option>";
                                ?>
                            </select>
                            </select>
                    </tr>
                    <tr>
                        <td>House Number</td><td> <input type="text" name="gharnumber" maxlength="20"/></td>
                    </tr>
                    <tr>
                        <td>Water</td><td>
                            <select name="water">
                                <option selected="selected">Yes</option>
                                <option>No</option>
                            </select>
                        </td><td>Water Bill (Rs.)</td><td>
                            <input type="text" name="water_bill" value="water bill per month" maxlength="20" />
                        </td><td>(Black if no rent)</td>
                    </tr>
                    <tr>
                        <td>Electricity</td><td>
                            <select name="electricity">
                                <option selected="selected">Yes</option>
                                <option>No</option>
                            </select>
                        </td><td>Electricity Bill (Rs.)</td><td>
                            <input type="text" name="electricity_bill" value="water bill per month" maxlength="20"/>
                        </td><td>(Black if no rent)</td>
                    </tr>
                    <tr>
                        <td>Internet</td><td>
                            <select name="internet">
                                <option selected="selected">Yes</option>
                                <option>No</option>
                            </select>
                        </td><td>Internet Bill (Rs.)</td><td>
                            <input type="text" name="internet_bill" value="water bill per month" maxlength="20"/>
                        </td><td>(Black if no rent)</td>
                    </tr>
                    <tr>
                        <td>Contact Number</td><td><input type="text" name="phone_number" maxlength="20"/></td>
                    </tr>
                    <tr>
                        <td>Transportation Distance  </td><td><input type="text" name="transportation_distance" maxlength="10"/></td><td>(approx. in Km)</td>
                    </tr>
                    <tr>
                        <td>Floor</td><td><input type="text" name="floor" maxlength="3"/></td>
                    </tr>
                    <tr>
                        <td>Rent (Rs.)</td><td><input type="text" name="rent" maxlength="13"/></td>
                        <td>Rent Negotiable</td><td>
                            <select name="rent_negotiable">
                                <option selected="selected">Yes</option>
                                <option>No</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Other Info:<td><textarea name="other_info" rows="5" cols="25" ></textarea></td>
                    </tr>
                    <tr>
                        <td></td><td><input type="reset" name="reset" value="Reset" style="width:100px;height:50px;text-align:center;"/></td><td><input type="Submit" name="submit_button" value="Proceed" style="width:100px;height:50px;text-align:center;" /></td>
                    </tr>
                </table>
            </center>
            </form>
        </div>
</div>
