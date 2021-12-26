<?php 

require_once 'db_connect.php';
$userid = $_GET['userid'];
$productid = $_GET['productid'];	
$comment = $_GET['comment'];
$today = date('y-m-d');
	
		$sql="INSERT INTO `review`(`content`, `daterev`, `user_id`, `product_id`) VALUES ('$comment','$today','$userid','$productid')";
				if($connect->query($sql) === TRUE) {

 				 echo "<SCRIPT type='text/javascript'> //not showing me this
        		alert('Review added !');
       			 window.location.replace(\"http://localhost/stock/boyka-v2/boyka/productdetails.php?idproduct='$productid'\");	
        		</SCRIPT>";
				} else {
					echo "error";
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the members";
				}				
?>
