



<?php
    
$errorpafelocation = 'Location: error_page.php?err_msg=';
include 'db_connection.php';

$emailorid = $_POST["emailorid"]; 
$pass = $_POST["password"]; 

session_start();

    $query = "SELECT admin_password FROM admin WHERE admin_email ='".$emailorid."'";

    $result = mysqli_query($conn, $query);
    $passu;
    while ($row = $result->fetch_assoc()) {
        $passu = $row["admin_password"];
    }
     if($passu == $pass){
        $_SESSION['user'] = $emailorid;
       // $_SESSION['admin'] = "admin";
        header('Location: admin_dashboard.php');
     }else{
         header($errorpafelocation);
     }
mysqli_close($conn);
exit;

?>


              