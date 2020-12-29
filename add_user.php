<?php 


if(isset($_POST['register'])){
	include_once('sql_connect.php');
	$mail = $_POST['mail'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$repeat_password = $_POST['repeat_password'];

	if(empty($mail) || empty($username) || empty($password) || empty($repeat_password)){
		header("Location: admin_page.php?error=emptyfields&mail=".$mail."&username=".$username);
		exit();
	}
	else if (!filter_var($mail, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		header("Location: admin_page.php?error=invalid_mail_and_username");
		exit();
	}
	else if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
		header("Location: admin_page.php?error=invalid_mail&username=".$username);
		exit();
	}
	else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		header("Location: admin_page.php?error=invalid_username&mail=".$mail);
		exit();
	}
	else if($password != $repeat_password){
		header("Location: admin_page.php?error=password_dont_match&mail=".$mail."&username=".$username);
		exit();
	}
	else{
		$sql = "SELECT user_name FROM users WHERE user_name = ?;";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: admin_page.php?error=mysqlerror");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if ($resultCheck > 0) {
				header("Location: admin_page.php?error=user_taken&mail=".$mail);
				exit();
			}
			else{
				$sql = "INSERT INTO users (user_name, user_mail, user_password) VALUES (?, ?, ?);";
				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt, $sql)){
					header("Location: admin_page.php?error=mysqlerror");
					exit();
				}
				else{
					$hashPassword  = password_hash($password, PASSWORD_DEFAULT);

					mysqli_stmt_bind_param($stmt, "sss", $username, $mail, $hashPassword);
					mysqli_stmt_execute($stmt);

					header("Location: admin_page.php?registration=succes");
					exit();
				}
			}
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}

else{
	header("Location: admin_page.php?register=faild");
}


?>