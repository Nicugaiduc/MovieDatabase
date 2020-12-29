<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add a Movie</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
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
				<h1>Help us make our database bigger</h1>
			</div>
			<form id="add_movie" action="add.php" method="POST">
				<div class="input_field">
					<input type="text" id="movie_title" name="movie_title" value="" placeholder="Movie Title">	
				</div>
				<div class="input_field">
					<input type="number" id="movie_year" name="movie_year" value="" placeholder="Movie Year">	
				</div>
				<div class="input_field">
					<input type="number" id="movie_runtime" name="movie_runtime" value="" placeholder="movie Runtime">	
				</div>
				<div class="input_field">
					<input type="text" id="movie_genre" name="movie_genre[]" value="" placeholder="Movie Genres // Exemplu(gen1, gen2)">	
				</div>
				<div class="input_field">
					<input type="text" id="movie_actors" name="movie_actors[]" value="" placeholder="Movie Actors // Exemplu(actor1, actor2)">	
				</div>
				<div class="input_field">
					<input type="text" id="movie_director" name="movie_director[]" value="" placeholder="Movie Directors // Exemplu(dir1, dir2)">	
				</div>
				<div class="input_field">
					<input type="text" id="movie_plot" name="movie_plot" value="" placeholder="Movie Plot">		
				</div>
				<div class="input_field">
					<input type="url" id="movie_image" name="movie_image" value="" placeholder="Movie Image URL">	
				</div>
				<button class="btn" name="submit" value="submit"> Submit </button>
			</form> 	
		</div>
			
	</div>




	

</body>
</html>