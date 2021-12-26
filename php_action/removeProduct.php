<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$productId = $_GET['productId'];

if($productId) { 

 $sql = "DELETE FROM Product WHERE product_id = {$productId}";

 if($connect->query($sql) === TRUE) {

 	 echo "<SCRIPT type='text/javascript'> //not showing me this
        alert('Product removed !');
        window.location.replace(\"http://localhost/stock/product.php\");
        </SCRIPT>";	
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 
 $connect->close();

 
} // /if $_POST