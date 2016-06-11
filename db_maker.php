<?php


$sheet = "cash_flow_statement";


$servername = "localhost";
$username = "root";
$password = "";
$db = "capcmr";

// Create connection
$conn = mysqli_connect($servername, $username, $password);


// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$db_selected = mysqli_select_db($conn,"temp_db_for_capcmr");


if (!$db_selected) {
    die ('Can\'t use  temp_db_for_capcmr : ' . mysqli_error());
}else{
	echo "................db selected: temp_db_for_capcmr";
}




$query = "SELECT B FROM ".$sheet;

$result = mysqli_query($conn, $query);


$bullshit = array();
$i = 0;

$tags_query = array();
$tags_idx = 0;

while($row = $result->fetch_assoc()){
    
    $temp = $row["B"];
    if($temp != NULL){

    	$tempo = substr(strtolower(str_replace(' ', '_', $temp)),0,50);

    	$query_x = "INSERT INTO capcmr.tags (id, real_name, table_name) VALUES (\"".$tempo."\", \"".$temp."\", \"".$sheet. "\");";
    	$temp = $tempo;
    	$i++;
   		$bullshit[$i] = $temp;
   		
   		$tags_query [ $tags_idx ] = $query_x; 
   		$tags_idx++;
    }
    
}

echo "<p>removing duplicates</p>";

$bullshit2 = array();
$i2 = 0;

for($g = 1 ; $g < sizeof($bullshit); $g++){
	
	$t = $bullshit[ $g ];

	$repeat = false;
	for($g2 = 0 ; $g2 < sizeof($bullshit2); $g2++){
		if($t == $bullshit2[$g2]){
			$repeat = true;
		}
	}

	if(!$repeat){
		$bullshit2[$i2] = $t;
		$i2 ++;
		//echo "<h6>added </h6>";
	}
}

echo sizeof($bullshit2);

$db_selected = mysqli_select_db($conn,"capcmr");


if (!$db_selected) {
    die ('Can\'t use  capcmr : ' . mysqli_error());
}else{
	echo "..............db selected: capcmr";
}

$query2 = "CREATE TABLE capcmr.".$sheet." ( `year` VARCHAR(255) NOT NULL , `company_name` VARCHAR(255) NOT NULL ,";


$u = 2;

while($u < sizeof($bullshit2)){

	echo "<p>".$bullshit2[ $u ]."</p>";

	$query2 = $query2."`".$bullshit2[ $u ]."` VARCHAR(255) NULL ,";
	$u++;
}

$query2 = $query2 . " PRIMARY KEY (`company_name`)) ENGINE = InnoDB;";

//" `a` VARCHAR(255) NULL , `b` VARCHAR(255) NULL ,"." PRIMARY KEY (`company_name`)) ENGINE = InnoDB;"

echo "<p>".$query2."</p>";


$result = mysqli_query($conn, $query2);
if($result){
	echo "<h3>table created</h3>";

}else{
	echo "<h3>failed to create table</h3>";
}

echo "<h4> size of tags query: ".sizeof($tags_query)."</h4>";

for($g3 = 0 ; $g3 < sizeof($tags_query); $g3++){
	echo "running query: ".$tags_query[ $g3 ];
	$resultt = mysqli_query($conn, $tags_query[ $g3 ]);
	echo $resultt;
	echo "<br>";
}

?>
