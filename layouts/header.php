<?php
    require_once "/srv/http/KothaBajar/include/global.php";
 ?>
<html>
<head>
    <title><?php echo 'kothabajar | '.$current_selected_page ?></title>
    <link rel="stylesheet" href="<?php echo $domain_name.$css_path; ?>">
</head>
<body>
    <div class="header">
        <div class="kothabajar_title">
            <a href="<?php echo $domain_name; ?>" style="text-decoration:none;display:block;
            padding: 8px 15px"><div style="font-size:35px;font-align=left;align:left;
            text-decoration:none"><span style="color:#f00;">Kotha</span><span style="color:#000">Bajar</span>
                <span style="color:#00f">.com</span></div>
            </a>
        </div>
        <div class="nav_menu" id="nav_menu">
            <ul>
                <li><a class="<?php if(strcmp($current_selected_page,'home_page'))
                        echo 'unselected_menu_item';
                    else
                    echo 'active';
                    ?>" href="<?php echo $domain_name; ?>">Home</a></li>
                <li><a class="<?php if(strcmp($current_selected_page,'finder_page'))
                        echo 'unselected_menu_item';
                    else
                    echo 'active';
                    ?>" href="<?php echo $domain_name.'/Finder/'; ?>">Search</a></li>
                <li><a class="<?php if(strcmp($current_selected_page,'submit_page'))
                        echo 'unselected_menu_item';
                    else
                    echo 'active';
                    ?>" href="<?php echo $domain_name.'/Post/'; ?>">Post</a></li>
                <li><a class="<?php if(strcmp($current_selected_page,'about_page'))
                        echo 'unselected_menu_item';
                    else
                    echo 'active';
                    ?>" href="<?php echo $domain_name.'/About/'; ?>">About</a></li>
                <li><a class="<?php if(strcmp($current_selected_page,'contact_page'))
                        echo 'unselected_menu_item';
                    else
                    echo 'active';
                    ?>" href="<?php echo $domain_name.'/Contact/'; ?>">Contact</a></li>
                <li style="float:right; padding-top:5px; ">
                    <form class="main_menu_search_form" method="get">
                        <input type="text" name="search" value="Search by location"/>
                        <input type="button" value="search" text="search" calue="search" />
                    </form>
                </li>
                <?php
                    if($_SESSION['logined'] == false){
                        echo"
                        <li style='float:right'>
                        <a href='".$domain_name."/Login/'>Login</a>
                        </li>";
                    }else{
                        echo"
                        <li class='unselected_menu_item'>
                        <a href='".$domain_name."/Login/'>".$_SESSION['LoginUserName']."</a>
                        </li>";
                    }
                ?>
            </ul>
        </div>
    </div>
