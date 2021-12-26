<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$sizeName = $_POST['sizeName'];

	$sql = "INSERT INTO size (size) VALUES ('$sizeName')";

	if($connect->query($sql) === TRUE) {

	 echo "<SCRIPT type='text/javascript'> //not showing me this
        alert('Size added !');
        window.location.replace(\"http://localhost/stock/size.php\");
    </SCRIPT>";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the size";
	}
	 

	$connect->close();

 
}