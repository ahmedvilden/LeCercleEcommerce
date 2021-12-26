<?php 	

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());



if($_POST) {	
	$gender = $_POST['id_gender'];
	$userid = $_POST['userid'];
	$email = $_POST['useremail'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$password = md5($_POST['userpassword']);
	$oldpassword = md5($_POST['useroldpassword']);
	$birthday = $_POST['birthday'];
	$phonenumber=$_POST['phonenumber'];
	$sql ="SELECT * FROM users WHERE user_id = {$userid}";
	$query = $connect->query($sql);
	$result = $query->fetch_assoc();
	if($oldpassword == $result['password']) {
	$sql = "UPDATE users SET email = '$email',firstname='$firstname',lastname='$lastname',password='$password',phonenumber='$phonenumber',birthday='$birthday',gender='$gender' WHERE user_id = '$userid'";

	if($connect->query($sql) === TRUE) {
	 	echo "<SCRIPT type='text/javascript'> //not showing me this
        		alert('Successfully Updated !');
       			 window.location.replace(\"http://localhost/stock/boyka-v2/boyka/my-account.php\");	
        		</SCRIPT>";
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
	}
	 }else {
	 	echo "<SCRIPT type='text/javascript'> //not showing me this
        		alert('Incorrect old password !');
       			 window.location.replace(\"http://localhost/stock/boyka-v2/boyka/my-account.php\");	
        		</SCRIPT>";
	 }
	$connect->close();

 
} // /if $_POST