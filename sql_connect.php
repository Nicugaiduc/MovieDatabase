<?php
$hostname = "localhost";
$username = "root";
$password = "";
$bd = "movies";

$conn = mysqli_connect($hostname,$username,$password,$bd);

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}
?>