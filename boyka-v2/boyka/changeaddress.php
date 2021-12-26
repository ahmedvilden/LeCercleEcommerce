<?php 	

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_GET) {	

	$address = $_GET['newaddress'];
	$userid = $_GET['userid'];
	$sql = "UPDATE users SET address = '$address' WHERE user_id = '$userid'";

	if($connect->query($sql) === TRUE) {
	 	echo "<SCRIPT type='text/javascript'> //not showing me this
        		alert('Successfully Updated !');
       			 window.location.replace(\"http://localhost/stock/boyka-v2/boyka/my-account.php\");	
        		</SCRIPT>";
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
	}
	 
	$connect->close();

 
} // /if $_POST