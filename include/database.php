<?php
    $db_hostname = "localhost";
    $db_username = "kothabajari";
    $db_password = "j@30%!)*)&";
    $database_name = "kothabajar_db";

    $query = "USE DATABASE kothabajar_db";
    $CONNECTION =mysqli_connect($db_hostname,$db_username,$db_password) or
    die ('Cannot connect to the database');
    //$CONNECTION = new mysqli($hostname, $username, $password);
    /*if ($CONNECTION->connect_error){
        die('Connection Failed : '.$CONNECTION->connect_error);
    }

    if(!$CONNECTION->query($query)){
        die("database $database_name cannot found!, error: ".$CONNECTION->connect_error);
    }
*/

    mysqli_select_db($CONNECTION,'kothabajar_db') or
    die('Cannot select database!!');

    function isValidUserToLogin ($username, $password,$CONN){
            $qry = 'SELECT UserID,Username, Password from Users';
            $result = mysqli_query($CONN,$qry) or die('hahaha');

            if(!$result){
                print "There was an error on isValid() query";
            }

            while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                if(strcmp($username,$row['Username']) == 0 and
                    strcmp($password,$row['Password']) == 0){
                    return array('Username'=>$username, 'UserID'=>$row['UserID']);
                }
            }
        return false;
    }
?>
