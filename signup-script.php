<?php


   $sucesspagelocation  = 'Location: dashboard.php';
   $errorpafelocation = 'Location: error_page.php?err_msg=';



    include 'db_connection.php';

$name = $_POST["name"];
$password = $_POST["passwd"];
$emailorid = $_POST["emailorid"];

    $query = 'INSERT INTO users (user_name,user_email,user_password) VALUES ("'.$name.'","'.$emailorid.'","'.$password.'")';

  
    if (mysqli_query($conn, $query)) {
        header($sucesspagelocation);
        exit;

    }else {
    //do nothing
       header($errorpafelocation);
        exit;
    }


?>
