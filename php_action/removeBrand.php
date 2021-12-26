<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$brandId = $_GET['brandId'];

if($brandId) { 

 $sql = "DELETE from brands WHERE brand_id = {$brandId}";

 if($connect->query($sql) === TRUE) {
 	 echo "<SCRIPT type='text/javascript'> //not showing me this
        alert('Brand removed !');
        window.location.replace(\"http://localhost/stock/brand.php\");
    </SCRIPT>";	
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 
 $connect->close();

 
} // /if $_POST