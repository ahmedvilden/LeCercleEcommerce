<?php 

require_once 'db_connect.php';
session_start();
$check = 1;
if(!empty($_SESSION["shopping_cart"])){
foreach($_SESSION["shopping_cart"] as $keys => $values){
$id = $values['item_id'];
$sql = "SELECT * FROM product WHERE product_id = {$id}";
$query = $connect->query($sql);
$result = $query->fetch_assoc();
$quantite = $values['item_quantity'];
$q=$result['quantity']-$quantite;
if($q<0){
	
	echo "<SCRIPT type='text/javascript'> //not showing me this
        		alert('Quantity !');
       			 window.location.replace(\"http://localhost/stock/boyka-v2/boyka/shop.php\");	
        		</SCRIPT>";

}else{

$sql2 = "UPDATE product SET quantity='$q' WHERE product_id = '$id'";
if($connect->query($sql2) == TRUE) {
	$check=0;
	echo "<SCRIPT type='text/javascript'> //not showing me this
        		alert('Quantity updated !');
        		</SCRIPT>";

}
}
}
}
if($check==0){
$userid = $_GET['user'];
$fullname = $_GET['fullname'];	
$email = $_GET['email'];	
$address = $_GET['address'];	
$phonenumber = $_GET['phonenumber'];
$notes = $_GET['notes'];
$productsname = $_GET['productsname'];
$total=$_GET['amount']+15;
$userid=$_GET['user'];
$today = date('y-m-d');
		$sql3="INSERT INTO `checkout`(`Fullname`, `shippingaddress`, `phonenumber`, `products`, `total`, `notes`, `checkoutdate`, `status`, `user_id`) VALUES ('$fullname','$address','$phonenumber','$productsname','$total','$notes','$today',0,'$userid')";
				if($connect->query($sql3) === TRUE) {
				 unset($_SESSION["shopping_cart"]);
 				 echo "<SCRIPT type='text/javascript'> //not showing me this
        		alert('Checkout added ! Wait for admin confirmation!!');
       			 window.location.replace(\"http://localhost/stock/boyka-v2/boyka/index.php\");	
        		</SCRIPT>";
				} else {
					echo "error";
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the members";
				}		
}
		
?>
