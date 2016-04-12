<?php
    require_once 'database.php';
    require_once 'functions.php';

    session_start();
    $pages = array("home_page","finder_page","submit_page","about_page","contact_page","login_page","signup_page");
    $current_selected_page = "home_page";
    $domain_name = 'http://'.$_SERVER['SERVER_NAME'].'/KothaBajar';
    $site_root = $_SERVER['DOCUMENT_ROOT']."/KothaBajar/";
    $css_path = "/Styles/styles.css";
    $LoginUserID = 3;
    $LoginUserName = 'nouser';
    $logined = false;

    $_SESSION['LoginUserID'] = $LoginUserID;
    $_SESSION['LoginUserName'] = $LoginUserName;
    $_SESSION['logined'] = $logined;

    $district_name_list = ['Achham', 'Arghakhachi', 'Arghakhachi', 'Baglung', 'Baitadi', 'Bajhang', 'Bajura', 'Banke', 'Bara', 'Bardiya', 'Bhaktpur', 'Bhojpur', 'Chitwan', 'Dadeldhura', 'Dailekh', 'Dang', 'DarchulaAchham', 'Dhading', 'Dhankura', 'Dhanusa', 'Dolakha', 'Dolpa', 'Doti', 'Gorkha', 'Gulmi', 'Humla', 'Ilam', 'Jajarkot', 'Jhapa', 'Jhumla', 'Kailali', 'Kalikot', 'Kanchanpur', 'Kapilvastu', 'Kaski', 'Kathmandu', 'Kotang', 'Lalitpur', 'Lamjhung', 'Mahottari', 'Makwanpur', 'Manang', 'Morang', 'Mugu', 'Mustang', 'Myagdi', 'Nawalparasi', 'Nuwakot', 'Okhaldhunga', 'Palpa', 'Panchthar', 'Parbat', 'Parsa', 'Pyuthan', 'Ramechhap', 'Rasuwa', 'Rautahar', 'Rolpa', 'Rukum', 'Rupandehi', 'Salyan', 'Sankhuwasabha', 'Saptari', 'Sarlahi', 'Sayangja', 'Sindhuli', 'Sindhupalchowk', 'Siraha', 'Solukhumbu', 'Sunsari', 'Surkhet', 'Tanahun', 'Taplejung', 'Terhathum', 'Udayapur'];



 ?>
