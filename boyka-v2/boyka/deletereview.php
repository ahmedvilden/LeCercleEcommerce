<?php 

require_once 'db_connect.php';
$review = $_POST['reviewid'];
$productid = $_POST['productid'];
	
		$sql="DELETE FROM review WHERE id = '$review'";
				if($connect->query($sql) === TRUE) {
 				 echo "<SCRIPT type='text/javascript'> //not showing me this
        		alert('Review deleted !');
       			 window.location.replace(\"http://localhost/stock/boyka-v2/boyka/productdetails.php?idproduct='$productid'\");	
        		</SCRIPT>";
				} else {
					echo "error";
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the members";
				}				
?>
