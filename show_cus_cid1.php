<?php
session_start();
require_once 'dbconnect.php';

if(!isset($_SESSION['userSession1'])) {
   include_once("logout.php");
   exit;
}

$user_id = $_SESSION["userSession1"] ;

$query = $DBcon->query("SELECT * FROM user where user_id= '$user_id'");
$userRow=$query->fetch_array();
$_SESSION['userSession1'] = $userRow['user_id'];

if (isset($_POST['btn-view'])) {
 
$customer_id = strip_tags($_POST['customer_id']);
$customer_id = $DBcon->real_escape_string($customer_id);

$query = $DBcon->query("SELECT * FROM customer WHERE customer_id='$customer_id'");
$row=$query->fetch_array();
 
$count = $query->num_rows; 
 
if ( $count==1) {

$_SESSION['customerSession'] = $row['customer_id'];

header("Location:cus_detail1.php");

}
else {
echo "<script>alert('Invalied Customer Id or NIC')</script>";
 }
}


if (isset($_POST['btn-view'])) {
 
 $nic = strip_tags($_POST['nic']);
 $nic = $DBcon->real_escape_string($nic);

 $query = $DBcon->query("SELECT * FROM customer WHERE nic='$nic'");
 $row=$query->fetch_array();
 
 $count = $query->num_rows; 
 
 if ( $count==1) {
  $_SESSION['customerSession'] = $row['customer_id'];

 header("Location:cus_detail1.php");

}
 else {

echo "<script>alert('Invalid Customer ID or NIC Number!')</script>";
 }

 $DBcon->close();

}
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<link rel="stylesheet" href="css/styl.css" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Customer Service-Find customer</title>

<body>

<div  class="modal"> 
<div class="opacity"> 
<form class="modal-content " method="post" >

<header>
<h3>Customer Service Officer</h3>     
<h2 ><center>Find customer Details</center></h2>
</header>        
<div class="container">
<input type="text"  placeholder="Customer ID" name="customer_id"  />       
<h3><font color="black">OR</font></h3>
<input type="text"  placeholder="NIC Number" name="nic" >
</div>

<footer>       
<button type="submit" accesskey="e"  name="btn-view" id="btn-view">Enter
</button>       
<input type="button" accesskey="c" value="Cancel" onclick="window.location.href='cus_ser.php?back'" />
</footer>    
</form>
</div>
</div>
</body>
</html>