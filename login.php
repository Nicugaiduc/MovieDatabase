<?php 
if (isset($_POST['login'])) {
	include_once('sql_connect.php');

	$username = $_POST['username'];
	$password = $_POST['password'];

	if (empty($username) || empty($password)) {
			header("Location: login_page.php?error=empty_fields");
			exit();
	}
	else{
		$sql = "SELECT * FROM users WHERE user_name = ? OR user_mail = ?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: login_page.php?error=mysqlerror");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "ss", $username, $username);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if ($row = mysqli_fetch_assoc($result)) {
				$passCheck = password_verify($password, $row['user_password']);
				if ($passCheck == false) {
					header("Location: login_page.php?error=wrong_password");
					exit();
				}
				else {
					session_start();
					$_SESSION['user_indentificator'] = $row['user_id'];
					$_SESSION['username'] = $row['user_name'];

					header("Location: index.php?login=succes");
					exit();
				}
			}
			else{
				header("Location: login_page.php?error=no_user");
				exit();	
			}
		}
	}	
}
else{
	header("Location: login_page.php?login=faild");
}



?>