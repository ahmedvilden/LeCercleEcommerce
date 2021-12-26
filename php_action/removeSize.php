<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$sizeId = $_GET['sizeId'];

 $sql = "DELETE from size WHERE id = $sizeId";

 if($connect->query($sql) === TRUE) { 
 	echo "<SCRIPT type='text/javascript'> //not showing me this
        alert('Size removed !');
        window.location.replace(\"http://localhost/stock/size.php\");
    </SCRIPT>";			
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 
 $connect->close();

 
// /if $_POST