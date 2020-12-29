<?php 
	session_start();
	include_once 'sql_connect.php';
	$sql = "SELECT * FROM movies;";
	$result = mysqli_query($conn, $sql);
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
	
<?php 
	//$denumire = '{$_GET['genre']}';
	$sql3 = "SELECT genre_id FROM genres WHERE genre_name = '{$_GET['genre']}';";
	$genre_id = mysqli_query($conn, $sql3);
	$genre_id = mysqli_fetch_assoc($genre_id);
	?>

	<div class="section_container second_section_container flex_container flex_center">
	<div class="text header_text text_grad_purple_yellow">
			<h1><?php echo $_GET['genre']; ?></h1>
		</div>
		<?php while($row = mysqli_fetch_assoc($result)){ 
			$flag = 0;
			$sql2 = "SELECT genre_id FROM movie_genre WHERE movie_id = {$row['movie_id']};";
			$result2 = mysqli_query($conn, $sql2);
			$genres = mysqli_fetch_all($result2);
			$genres = array_column($genres, 0);
			if(in_array($genre_id['genre_id'], $genres)){
				$flag = 1;
			}
			if($flag == 1){
			?>
		<a href="single_movie.php?movie_id=<?php echo $row['movie_id'];?>">
			<div class="feature flex_feature_item feature1">
				<div class="feature_image">
					<img class="feature_image" src="<?php echo $row['movie_image'];?>" onError="this.onerror=null;this.src='https://www.citypages.com/img/movie-placeholder.gif';" alt="<?php echo $row['title'];?>">
				</div>
				<h4><?php echo $row['movie_title']; ?></h4>
				<!-- <p><?php echo $row['movie_plot'] ?></p> -->
			</div>
		</a>
		<?php
	}	 
	}
	 ?>	
	</div>
	
</body>
</html>