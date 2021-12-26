<?php 	

require_once 'core.php';

$sizeId = $_POST['sizeId'];

$sql = "SELECT id,size FROM size WHERE id = $sizeId";
$result = $connect->query($sql);


if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);