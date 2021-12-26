<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$genderId = $_GET['genderId'];

 $sql = "DELETE from gender WHERE id = $genderId";

 if($connect->query($sql) === TRUE) {
  echo "<SCRIPT type='text/javascript'> //not showing me this
        alert('Gender removed !');
        window.location.replace(\"http://localhost/stock/gender.php\");
    </SCRIPT>";			
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 
 $connect->close();
?>