<?php
include 'db_connection.php';


$Dept = $_POST['Dept'];
$Dept_2 = $_POST['Dept_2'];

/*
     $query_current_semester = "SELECT company_name FROM companies WHERE company_type = '".$Dept."'";
     $result_current_semester = mysqli_query($conn, $query_current_semester);
     $row = $result_current_semester->fetch_assoc();
      $semester = $row["Semester_name"];
      //end of detecting current semester


*/
$query = "SELECT * FROM companies WHERE company_name = '".$Dept."'";

$result = mysqli_query($conn, $query);


$bullshit = array();
$i = 0;


while($row = $result->fetch_assoc()){


	if( $row["company_income"] != NULL){
		$bullshit[$i] = "Income Statement";// $row["company_income"];
    	$i++;
	}
    
    if( $row["company_balance"] != NULL){
		$bullshit[$i] = "Balance Sheet";//$row["company_balance"];
    	$i++;
	}
    
    if( $row["company_cash"] != NULL){
		$bullshit[$i] = "Cash Flow Statement";//$row["company_cash"];
    	$i++;
	}
    
    if( $row["company_equity"] != NULL){
		$bullshit[$i] = "Statement of Equity";//$row["company_equity"];
    	$i++;
	}
    
    if( $row["company_liquidity"] != NULL){
		$bullshit[$i] = "Liquidity Statement";//$row["company_liquidity"];
    	$i++;
	}
    
    if( $row["company_income_banks"] != NULL){
		$bullshit[$i] = "Income Statement for Banks";//$row["company_income_banks"];
    	$i++;
	}
    

}

$row_array = json_encode($bullshit);

echo $row_array ;

?>
