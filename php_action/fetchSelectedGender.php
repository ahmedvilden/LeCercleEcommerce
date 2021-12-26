<?php 	

require_once 'core.php';

$genderId = $_POST['genderId'];

$sql = "SELECT id,gender FROM gender WHERE id = $genderId";
$result = $connect->query($sql);


if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);