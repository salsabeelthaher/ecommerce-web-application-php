
<?php

$conn = mysqli_connect('localhost', 'nomadforce', 'nmf2003','nomadforce');


function query($q){
	global $conn;
	return mysqli_query($conn,$q);
    //if(!$q){
		//print_r($q);
		//echo mysqli_error($conn);
	//}
}

	
function getservices(){
	global $conn;
	return query('select * from services',$conn);
}

function check($result){
	global $conn;
	if (!$result){
		echo mysqli_error ($conn);
	}
}
?>
