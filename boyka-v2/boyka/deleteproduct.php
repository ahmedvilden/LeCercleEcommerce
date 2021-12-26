<?php

require_once 'db_connect.php';


$valid['success'] = array('success' => false, 'messages' => array());

$productid = $_GET['productid'];

 $sql = "DELETE from product WHERE product_id = $productid";

 if($connect->query($sql) === TRUE) {
  echo "<SCRIPT type='text/javascript'> //not showing me this
        alert('product removed !');
        window.location.replace(\"http://localhost/stock/boyka-v2/boyka/my-account.php\");	
    </SCRIPT>";			
 } else {
 	echo "error while deleting !";
 }
 
 $connect->close();
?>