<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());


if($_POST) {	

  $productName 		= $_POST['productName'];
  //$productImage 	= $_POST['productImage'];
  $quantity 			= $_POST['quantity'];
  $rate 					= $_POST['rate'];
  $brandName 			= $_POST['brandName'];
  $categoryName 	= $_POST['categoryName'];
  $genderName = $_POST['genderName'];
  $sizeName = $_POST['sizeName'];
  $productStatus 	= $_POST['productStatus'];
  $description = $_POST['description'];
  $today = date('y-m-d');

	$type = explode('.', $_FILES['productImage']['name']);
	$type = $type[count($type)-1];			
	$url = '../assests/images/stock/'.uniqid(rand()).'.'.$type;	
	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
		if(is_uploaded_file($_FILES['productImage']['tmp_name'])) {		
		if(move_uploaded_file($_FILES['productImage']['tmp_name'], $url)){			
				$sql = "INSERT INTO product (product_name, product_image, brand_id, categories_id, quantity, price, active, status,gender_id,size_id,description,user_id,dateadded,discount)
				VALUES ('$productName', '$url', '$brandName', '$categoryName', '$quantity', '$rate', '$productStatus', 1,'$genderName','$sizeName','$description',null,'$today',0)";

				if($connect->query($sql) === TRUE) {

 	 echo "<SCRIPT type='text/javascript'> //not showing me this
        alert('Product added !');
        window.location.replace(\"http://localhost/stock/product.php\");	
        </SCRIPT>";
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the members";
				}
				}else{

				}
			
		} // if
	} // if in_array 		

	$connect->close();
 
} // /if $_POST