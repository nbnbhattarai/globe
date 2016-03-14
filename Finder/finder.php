<div class="body_section">

    <!--Left site panel of search form -->
    <div class="finder_left_list">
        <form method="get" name="searchform">
            <u>Category</u><br />
            <ul>
                <input type="checkbox" name="category[]" value="Apartment" <?php
                    if(!empty($_GET['category'])){
                        if(in_array('Apartment',$_GET['category']))
                                echo "checked='checked'";
                    }
                ?>"> Apartment<br />
                <input type="checkbox" name="category[]" value="Room" <?php
                    if(!empty($_GET['category'])){
                        if(in_array('Room',$_GET['category']))
                                echo "checked='checked'";
                    }
                ?>> Room<br />
                <input type="checkbox" name="category[]" value="House"  <?php
                    if(!empty($_GET['category'])){
                        if(in_array('House',$_GET['category']))
                                echo "checked='checked'";
                    }
                ?>> House<br />
            </ul>
            <u>Rent</u><br />
            <ul>
                <input <?php
                    if(!empty($_GET['rent_category'])){
                        if(in_array('Below',$_GET['rent_category'])){
                            echo "checked='checked'";
                        }
                    }
                ?> type="checkbox" name="rent_category[]" value="Below"/> Below <input type="text" name="rent_below_value" value="<?php
                if(isset($_GET['rent_below_value']))
                    echo $_GET['rent_below_value'];
                else {
                    echo '10000';
                }
                ?>"/><br />
                <input <?php
                    if(!empty($_GET['rent_category'])){
                        if(in_array('Above',$_GET['rent_category'])){
                            echo "checked='checked'";
                        }
                    }
                ?> type="checkbox" name="rent_category[]" value="Above"/> Above <input type="text" name="rent_above_value" value="<?php
                if(isset($_GET['rent_above_value']))
                    echo $_GET['rent_above_value'];
                else {
                    echo '10000';
                }
                ?>"/><br />
            </ul>
    </div>

    <div style="text-align:left;padding:0">
            <input type="text" name="search" value="<?php
            if(isset($_GET['search'])) echo $_GET['search']; ?>" style="width:250px" />
            <select name="search_district">
                <option selected="selected">(choose one)</option>
                <?php
                for($i=0; $i < 75; $i++){
                    if(isset($_GET['search_district'])){
                        if($i == getDistrictIndex($_GET['search_district'],$district_name_list))
                        echo "<option selected='selected'>".$district_name_list[$i]."</option>";
                        else
                        echo "<option>".$district_name_list[$i]."</option>";
                    }
                    else
                    echo "<option>".$district_name_list[$i]."</option>";
                }
                ?>
            </select>

            <input type="submit" value="search" style="width:70px"/>
            Order By
            <select name="order_by">
                <option <?php
                if(isset($_GET['order_by'])){
                    if(strcmp($_GET['order_by'],"Type") == 0)
                        echo "selected='selected'";
                }
                ?> value="Type">Type</option>
                <option <?php
                if(isset($_GET['order_by'])){
                    if(strcmp($_GET['order_by'],"Rent") == 0)
                        echo "selected='selected'";
                }
                ?> value="Rent">Rent</option>
                <option <?php
                if(isset($_GET['order_by'])){
                    if(strcmp($_GET['order_by'],"CreateDate") == 0)
                        echo "selected='selected'";
                }
                ?> value="CreateDate">Submitted Date</option>
                <option <?php
                if(isset($_GET['order_by'])){
                    if(strcmp($_GET['order_by'],"District") == 0)
                        echo "selected='selected'";
                }
                ?> value="District">District</option>
            </select>

            <select name="asc_desc">
                <option <?php
                    if(isset($_GET['asc_desc'])){
                        if(strcmp($_GET['asc_desc'],"ASC") == 0)
                            echo "selected='selected'";
                    }
                ?> value="ASC">ASC</option>
                <option <?php
                    if(isset($_GET['asc_desc'])){
                        if(strcmp($_GET['asc_desc'],"DESC") == 0)
                            echo "selected='selected'";
                    }
                ?> value="DESC">DESC</option>
            </select>
    </div>
</form>
    <div class="finder_result">
        <table>
            <tr>
                <td>SN</td><td>Type</td><td>Name</td><td>District</td><td>Rent</td><td>Submitted Date</td>
            </tr>
            <?php
                if(isset($_GET['search']))
                    $locationText = $_GET['search'];
                else
                    $locationText = "";

                $category = 0;
                if(!empty($_GET['category'])){
                    foreach ($_GET['category'] as $value) {
                        if(strcmp($value,'Apartment') == 0)
                            $category += 1;
                        if(strcmp($value,'Room') == 0)
                            $category += 2;
                        if(strcmp($value,'House') == 0)
                            $category += 4;
                    }
                }

                $rent_category = 0;
                if(!empty($_GET['rent_category'])){
                    foreach ($_GET['rent_category'] as $value) {
                        if(strcmp($value,'Below') == 0)
                            $rent_category += 1;
                        if(strcmp($value,'Above') == 0)
                            $rent_category += 2;
                    }
                }

                if(isset($_GET['rent_below_value']) && isset($_GET['rent_above_value'])){
                    $rent_values = array($_GET['rent_below_value'],$_GET['rent_above_value']);
                }

                if(isset($_GET['search_district']))
                    $district_name = $_GET['search_district'];
                else
                    $district_name = "*";

                $order_by = "Rent";
                if(isset($_GET['order_by'])){
                    $order_by = $_GET['order_by'];
                }

                $order_asc_desc = "ASC";
                if(isset($_GET['asc_desc'])){
                    $order_asc_desc = $_GET['asc_desc'];
                }

                $ordering = array('order_by'=>$order_by,'order_asc_desc'=>$order_asc_desc);

                if(isset($_GET['search']) or isset($_GET['category']) or isset($_GET['rent_category']) or isset($_GET['search_district'])){
                    $rooms = getSearchResult ($locationText, $category, $rent_category, $rent_values, $district_name, $ordering, $district_name_list, $CONNECTION);
                    if($rooms){
                        $count_fr = 1;
                        foreach ($rooms as $room) {
                            if($count_fr%2 == 0)
                                echo "<tr style='background-color:#fa0'>";
                            else
                                echo "<tr style='background-color:#a0f'>";

                            $typechar = array('A'=>'Apartment','H'=>'House','R'=>'Room','E'=>'Unspecified');
                                echo "<td> ".$count_fr." </td>";
                                echo "<td> ".$typechar[$room['Type']]." </td>";
                                echo "<td> ".$room['Name']." </td>";
                                echo "<td> ".$room['District']." </td>";
                                echo "<td> ".$room['Rent']." </td>";
                                echo "<td> ".$room['CreateDate']." </td>";
                            echo "</tr>";
                            $count_fr++;
                        }
                    }else{
                        printMessage("No Result Found on these category!");
                    }
                }
             ?>
        </table>
    </div>
</div>
