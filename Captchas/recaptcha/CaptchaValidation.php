<?php
include("getCurlData.php");
if (isset($_POST['email']) and isset($_POST['userpassowrd']) and isset($_POST['g-recaptcha-response']))
{

$email = $_POST['email'];
$password = $_POST['userpassowrd'];
$recaptcha = $_POST['g-recaptcha-response'];	
	
$google_url="https://www.google.com/recaptcha/api/siteverify";
$secret='6Lf42joUAAAAAJROMSxnCKmAOX29VWIaFhLXKLjn';
$ip=$_SERVER['REMOTE_ADDR'];
$url=$google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;
$res=getCurlData($url);
$res= json_decode($res, true);

if($res['success'])
{
//Include login check code
echo "Successful...";
}
else{
	echo "Please re-enter your reCAPTCHA.";
}
	
}
else{
	echo "Please re-enter your reCAPTCHA.";
}	

?>