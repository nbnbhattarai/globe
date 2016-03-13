<div class="body_section">
    <div class="finder_left_list">
        <u>Category</u><br />
        <ul>
            <input type="checkbox" name="finder_checkbox_apartment" value="Apartment" >Apartment<br />
            <input type="checkbox" name="finder_checkbox_room" value="Room" >Room<br />
            <input type="checkbox" name="finder_checkbox_house" value="House"  >House<br />
        </ul>
        <u>Rent</u><br />
        <ul>
            <input type="checkbox" name="finder_checkbox_rent1" value=" < 3000" />< Rs. 3,000 <br />
            <input type="checkbox" name="finder_checkbox_rent2" value=" < 3000" />  Rs. 3,000 -> Rs. 5,000 <br />
            <input type="checkbox" name="finder_checkbox_rent3" value=" < 3000" />< Rs. 5,000 -> Rs. 10,000 <br />
            <input type="checkbox" name="finder_checkbox_rent4" value=" < 3000" />< Rs. 10,000 -> Rs. 15,000 <br />
            <input type="checkbox" name="finder_checkbox_rent5" value=" < 3000" />> Rs. 15,000 <br />
        </ul>
    </div>
    <div class="finder_right">
        <form method="get">
            <input type="text" name="search" value="<?php
            if(isset($_GET['search'])) echo $_GET['search']; ?>" style="width:250px" />
            <input type="submit" value="search" style="width:70px"/><br />
        </form>
    </div>
    <div class="finder_result">
    </div>
</div>
