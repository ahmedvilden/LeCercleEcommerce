<?php 

require_once 'db_connect.php';
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];	
$email = $_POST['email'];
$message = $_POST['message'];
$subject = $_POST['subject'];
$user = $_POST['user'];
$today = date('y-m-d');
	
		$sql="INSERT INTO `reclamation`(`firstname`, `lastname`, `email`, `subject`, `message`, `dateadded`, `user_id`) VALUES ('$firstname','$lastname','$email','$subject','$message','$today','$user')";
				if($connect->query($sql) === TRUE) {

 				 echo "<SCRIPT type='text/javascript'> //not showing me this
        		alert('Reclamation sent !');
       			 window.location.replace(\"http://localhost/stock/boyka-v2/boyka/index.php\");	
        		</SCRIPT>";
				} else {
					echo "error";
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the members";
				}				
?>
