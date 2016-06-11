<?php
include 'db_connection.php';


$data = $_POST['Dept'];
$company = $_POST['company'];

$data = strtolower(str_replace(' ', '_', $data));

$query = "SELECT DISTINCT(year) FROM ".$data." WHERE company_name = '".$company."'";

$result = mysqli_query($conn, $query);


$bullshit = array();
$i = 0;


while($row = $result->fetch_assoc()){
    
    $bullshit[$i] = $row["year"];
    $i++;
}

$row_array = json_encode($bullshit);

echo $row_array ;

?>
