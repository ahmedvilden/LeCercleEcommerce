<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_GET) {	

  	$checkoutid = $_GET['checkoutid'];

	$sql = "UPDATE checkout SET status = 1 WHERE id = '$checkoutid'";

	if($connect->query($sql) === TRUE) {
	 echo "<SCRIPT type='text/javascript'> //not showing me this
        alert('Product approved !');
        window.location.replace(\"http://localhost/stock/product.php\");
    </SCRIPT>";
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST