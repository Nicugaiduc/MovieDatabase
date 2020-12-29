<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="de-CH">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/style.css">
<link href="https://fonts.googleapis.com/css?family=Pacifico|Rubik" rel="stylesheet">
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<!--START META DATA PAGE DESCRIPTION-->
<meta name="Author" content="Calmar Solutions Schweiz - Erin McGowan - www.calmarsolutions.ch">
<meta name="Copyright" content="Calmar Solutions">
<meta name="Credit" content="https://thenounproject.com/">
<meta name="description" content="Margs Surfcamp Margaret River">
<meta name="keywords" content="Surfing, Camping, Margaret River, Western Australia">
<!--END META DATA PAGE DESCRIPTION-->
<title>Movie Page</title>
</head>
<body>
<a href="#top"><img class="arrow_image" src="img/arrow.svg"></a>
<a name="top"></a>
<div id="change_class" class="flex_container section menu_section">
	<div class="flex_item branding"><p></p></div>
	<div class="flex_item menu_item dropdown">
		<p>Menu</p>
		<div class="dropdown-content">
			<div class="menu_item menu_item_inside"><a href="index.php"><p>Home</p></a></div>
			<div class="menu_item menu_item_inside"><a href="genres.php"><p>Genres</p></a></div>
			<div class="menu_item menu_item_inside"><a href="add_movie.php"><p>Add a Movie</p></a></div>
			<div class="menu_item menu_item_inside"><a href="login_page.php"><p>Log-in/Sign-in</p></a></div>
		</div>
	</div>
	<div class="flex_item menu_item menu_item_outside"><a href="index.php"><p>Home</p></a></div>
	<div class="flex_item menu_item menu_item_outside"><a href="genres.php"><p>Genres</p></a></div>
	<div class="flex_item menu_item menu_item_outside"><a href="add_movie.php"><p>Add a Movie</p></a></div>
	<?php
	if(isset($_SESSION['user_indentificator'])){
	?>
	<div class="flex_item menu_item menu_item_outside"><form action="logout.php"><button class="logout1" href="#"><p>Logout</p></button></form></div>
	<?php } else{?>
	 
	<div class="flex_item menu_item menu_item_outside"><a href="login_page.php"><p>Log-in/Sign-in</p></a></div>
<?php } ?>
</div>


<div class="form_container">
		<div class="form_wrapper">
			<div class="text_grad_purple_yellow">
				<h1>Hello, Movie Lover</h1>
			</div>
			<form id="add_movie" action="register.php" method="POST">
				<h3>Don't have an account? Register now</h3>
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

			<form id="add_movie" action="login.php" method="POST">
				<h3>Have an account? Log in</h3>
				<div class="input_field">
					<input type="text" id="user_name" name="username" value="" placeholder="Username">	
				</div>
				<div class="input_field">
					<input type="password" id="password" name="password" value="" placeholder="Password">	
				</div>
				<button class="btn" name="login" value="login"> Log In </button>
			</form> 	
		</div>
			
	</div>


</body>
</html>