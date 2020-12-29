<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div id="change_class" class="flex_container section menu_section">
	<div class="flex_item branding"><p></p></div>
	<div class="flex_item menu_item dropdown">
		<p>Menu</p>
		<div class="dropdown-content">
			<div class="menu_item menu_item_inside"><a href="admin_page.php"><p>Home</p></a></div>
			<div class="menu_item menu_item_inside"><a href="admin_add_user.php"><p>Add an User</p></a></div>
			<div class="menu_item menu_item_inside"><a href="admin_add_movie.php"><p>Add a Movie</p></a></div>
		</div>
	</div>
	<div class="flex_item menu_item menu_item_outside"><a href="admin_page.php"><p>Home</p></a></div>
	<div class="flex_item menu_item menu_item_outside"><a href="admin_add_user.php"><p>Add an User</p></a></div>
	<div class="flex_item menu_item menu_item_outside"><a href="admin_add_movie.php"><p>Add a Movie</p></a></div>
	</div>
	<div class="form_container">
		<div class="form_wrapper">
			<div class="text_grad_purple_yellow">
				<h1>Hello Admin</h1>
			</div>
			<form id="add_movie" action="add_user.php" method="POST">
				<h3>Add a Movie Lover</h3>
				<div class="input_field">
					<input type="text" id="mail" name="mail" value="" placeholder="Your e-mail">	
				</div>
				<div class="input_field">
					<input type="text" id="user_name" name="username" value="" placeholder="Username">	
				</div>
				<div class="input_field">
					<input type="password" id="password" name="password" value="" placeholder="Password">	
				</div>
				<div class="input_field">
					<input type="password" id="repeat_password" name="repeat_password" value="" placeholder="Repeat Password">
				</div>
				<button class="btn" name="register" value="register"> Registre </button>
			</form> 
		</div>
			
	</div>
</body>
</html>