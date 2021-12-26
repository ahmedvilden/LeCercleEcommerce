<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$categoriesId = $_GET['categorieId'];

if($categoriesId) { 

 $sql = "DELETE from categories where categories_id = $categoriesId";

 if($connect->query($sql) === TRUE) {
 	 echo "<SCRIPT type='text/javascript'> //not showing me this
        alert('Categorie removed !');
        window.location.replace(\"http://localhost/stock/categories.php\");
    </SCRIPT>";	
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 
 $connect->close();

 
} // /if $_POST