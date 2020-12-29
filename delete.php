<?php 
include_once("sql_connect.php");
$id = $_GET['delete'];
$sql = "DELETE FROM users WHERE user_id = $id; ";
if(mysqli_query($conn, $sql)){
	header("Location: admin_page.php?delete=succes");
}

?>