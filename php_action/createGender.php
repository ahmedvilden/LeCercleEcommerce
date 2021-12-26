<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$genderName = $_POST['genderName'];

	$sql = "INSERT INTO gender (gender) VALUES ('$genderName')";

	if($connect->query($sql) === TRUE) {

	 echo "<SCRIPT type='text/javascript'> //not showing me this
        alert('Gender added !');
        window.location.replace(\"http://localhost/stock/gender.php\");
    </SCRIPT>";
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the gender";
	}
	 

	$connect->close();

 
}