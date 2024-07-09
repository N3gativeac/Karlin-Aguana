<?php
ob_start(); //Turns on output buffering 


$timezone = date_default_timezone_set("Asia/Manila");

$con = mysqli_connect("localhost", "root", "", "sukelco_db"); //Connection variable

if(mysqli_connect_errno()) 
{
	echo "Failed to connect: " . mysqli_connect_errno();
}

?>