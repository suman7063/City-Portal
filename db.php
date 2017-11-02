<?php
$conn=mysqli_connect("localhost","root","","city");
if($conn->connect_error)
{
	die("connection failed".$conn->connect_error);
}
else
{
	$a='hi';
}
?>