<?php 	

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_GET) {
	$brandName 			= $_GET['brandName'];
 $categoryName 	= $_GET['categoryName'];
  $genderName = $_GET['genderName'];
  $sizeName = $_GET['sizeName'];
	$productId = $_GET['productid'];
	$productName 		= $_GET['name']; 
  $quantity 			= $_GET['quantity'];
  $rate 					= $_GET['price'];
  $discount = $_GET['discount'];
  $description = $_GET['description'];
	
				
	$sql = "UPDATE product SET product_name = '$productName', brand_id = '$brandName', categories_id = '$categoryName', quantity = '$quantity', price = '$rate',  status = 1,gender_id='$genderName',size_id='$sizeName',discount='$discount',description='$description' WHERE product_id = $productId";

	if($connect->query($sql) === TRUE) {
		echo "<SCRIPT type='text/javascript'> //not showing me this
        		alert('product modified !');
       			 window.location.replace(\"http://localhost/stock/boyka-v2/boyka/my-account.php\");	
        		</SCRIPT>";
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating product info";
	}
	

} // /$_GET
	 
$connect->close();
 
