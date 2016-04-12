<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/KothaBajar"."/include/global.php";
    $current_selected_page = 'finder_page';
    include $site_root."layouts/header.php";
    include $site_root."Finder/finder.php";
    include $site_root."layouts/footer.php";
?>
