



<?php
    
$errorpafelocation = 'Location: error_page.php?err_msg=';
include 'db_connection.php';

$emailorid = $_POST["emailorid"]; 
$pass = $_POST["password"]; 

session_start();

    $query = "SELECT user_password FROM users WHERE user_email ='".$emailorid."'";

    $result = mysqli_query($conn, $query);
    $passu;
    while ($row = $result->fetch_assoc()) {
        $passu = $row["user_password"];
    }
     if($passu == $pass){
        $_SESSION['user'] = $emailorid;
        header('Location: dashboard.php');
     }else{
         header($errorpafelocation);
     }
mysqli_close($conn);
exit;

?>


              