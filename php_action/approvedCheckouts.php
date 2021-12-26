<?php 	

require_once 'core.php';

$sql = "SELECT * FROM checkout WHERE status = 1 order by checkoutdate desc";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();

 while($row = $result->fetch_array()) {

 	$output['data'][] = array( 		
 		$row[0],
 		$row[1],
 		$row[2],
 		$row[3],
 		$row[4],
 		$row[5],
 		$row[6],
 		$row[7],
 		$row[8],
 		$row[9]
 		); 	
 } // /while 
} // if num_rows

$connect->close();