<?php 
	session_start();
	include_once 'sql_connect.php';
	$sql = "SELECT * FROM genres;";
	$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
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
	
	<div class="container">
		<?php 
		while($row = mysqli_fetch_assoc($result)){
		?>
			<a href="genre_filtre.php?genre=<?php echo $row['genre_name'];?>"class="genres_item" style="background-color: <?php echo("#FFDC".rand(55,99));?>">
				<span><?php echo $row['genre_name']; ?></span>
			</a>	
		<?php } ?>	
	</div>

	<div class="section footer_section">
	<a href="https://www.facebook.com/nick.gaiduc"><p class="footer_text">Site creat de Nicolae Gaiduc</p></a>
</div>
</body>
</html>