<?php 

require_once 'db_connect.php';

// remove all session variables
session_start();
session_unset(); 
unset($_SESSION['userId']);
session_destroy();
// destroy the session 

header('location: http://localhost/stock/boyka-v2/boyka/login-register.php');

?>