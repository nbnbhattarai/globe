<?php
        require_once $_SERVER['DOCUMENT_ROOT']."/KothaBajar"."/include/global.php";
        if(isset($_GET['msg'])){
            if(strcmp($_GET['msg'],'logout') == 0){
                if(isset($_COOKIE['user'])){
                    setcookie('user','3',time() - 3600,"/");
                    echo 'Logout';
                    echo "<script>window.location.reload(true);</script>";
                }
            }
        }
        include $site_root."layouts/header.php";
        include $site_root."home.php";
        include $site_root."layouts/footer.php";
 ?>
