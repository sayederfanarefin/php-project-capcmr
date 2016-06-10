<?php
include 'db_connection.php';


$Dept = $_POST['Dept'];

/*
     $query_current_semester = "SELECT company_name FROM companies WHERE company_type = '".$Dept."'";
     $result_current_semester = mysqli_query($conn, $query_current_semester);
     $row = $result_current_semester->fetch_assoc();
      $semester = $row["Semester_name"];
      //end of detecting current semester


*/
$query = "SELECT company_name FROM companies WHERE company_type = '".$Dept."'";

$result = mysqli_query($conn, $query);


$bullshit = array();
$i = 0;
while($row = $result->fetch_assoc()){
    
    $bullshit[$i] = $row["company_name"];
    $i++;
}

$row_array = json_encode($bullshit);

echo $row_array ;

?>
