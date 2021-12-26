<?php
require_once'db_connect.php';
if($_POST) {

$username = $_POST['username'];
$mail = $_POST['useremail'];
$userpassword = md5($_POST['userpassword']);
$confirmpassword = md5($_POST['confirmpassword']);
$phonenumber = $_POST['phonenumber'];
$address = $_POST['address'];
$birthday = $_POST['birthday'];
$gender = $_POST['gender'];
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$type = explode('.', $_FILES['profilepic']['name']);
	$type = $type[count($type)-1];		
	$url = 'assets/images/profilepic/'.uniqid(rand()).'.'.$type;
	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
		if(is_uploaded_file($_FILES['profilepic']['tmp_name'])) {			
			if(move_uploaded_file($_FILES['profilepic']['tmp_name'], $url)) {
				if($confirmpassword == $userpassword){
				$sql = "INSERT INTO users (username, email, password, phonenumber, address, birthday, profilepic,gender,firstname,lastname) 
				VALUES ('$username', '$mail', '$userpassword', '$phonenumber', '$address', '$birthday', '$url','$gender','$firstname','$lastname')";
			}else{
				 echo "<SCRIPT type='text/javascript'> //not showing me this
        		alert('Passwords don't match !');
       			 window.location.replace(\"http://localhost/stock/boyka-v2/boyka/login-register.php\");	
        		</SCRIPT>";
			}
				if($connect->query($sql) === TRUE) {
			}

 	 echo "<SCRIPT type='text/javascript'> //not showing me this
        alert('Successfully registered !');
        window.location.replace(\"http://localhost/stock/boyka-v2/boyka/login-register.php\");	
        </SCRIPT>";
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the members";
				}

			}	else {
				return false;
			}	// /else	
		} // if
	 // if in_array 		

	$connect->close();
}

?>