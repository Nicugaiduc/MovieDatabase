<?php 
	session_start();
	$movie_indentificator = $_GET['movie_id'];
	include_once 'sql_connect.php';
	$sql = "SELECT * FROM movies;";
	$result = mysqli_query($conn, $sql);

	function convert_time($time){
		$h = (int)($time/60);
		$m = $time%60;
		echo $h." h ".$m." m";
	}
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
	<!-- <a href="#top"><img class="arrow_image" src="img/arrow.svg"></a>
	<a name="top"></a> -->
	<div class="gradient_red_yellow2">
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
		<div class="movie_container">
			<?php 
		while($row = mysqli_fetch_assoc($result)){
			if($row['movie_id'] == $_GET['movie_id']){
		?>
			<h1><?php echo $row['movie_title']; ?></h1>
			<div class="movie">
				<img src="<?php echo $row['movie_image'];?>" alt="" class="movie_iamge" onError="this.onerror=null;this.src='https://www.citypages.com/img/movie-placeholder.gif';">
				<div class="about_movie">
					<p class="movie_year movie_detail"><span class="about_title">Year: </span> <?php echo $row['movie_year']; ?></p>
					<p class="movie_runtime movie_detail"><span class="about_title">Runtime: </span><?php convert_time($row['movie_runtime']); ?></p>
					
					<p class="movie_genres movie_detail">
						<span class="about_title">Genres: </span>
						<?php
						$sql2 = "SELECT genre_id FROM movie_genre WHERE movie_id = {$row['movie_id']};";
						$result2 = mysqli_query($conn,$sql2);
						$genres = mysqli_fetch_all($result2);
						$genres = array_column($genres, 0) ;
						for($i=0; $i<count($genres);$i++){
							$genre = mysqli_fetch_assoc(mysqli_query($conn, "SELECT genre_name FROM genres WHERE genre_id = '{$genres[$i]}';"));
							echo $genre['genre_name'];
							echo $genres[$i] != end($genres) ? ', ' : '';
						}
						?>	
					</p>
					<p class="movie_actors movie_detail">
						<span class="about_title">Actors: </span> 
						<?php
						$sql2 = "SELECT actor_id FROM movie_actor WHERE movie_id = {$row['movie_id']};";
						$result2 = mysqli_query($conn,$sql2);
						$actors = mysqli_fetch_all($result2);
						$actors = array_column($actors, 0) ;
						for($i=0; $i<count($actors);$i++){
							$actor = mysqli_fetch_assoc(mysqli_query($conn, "SELECT actor_name FROM actors WHERE actor_id = '{$actors[$i]}';"));
							echo $actor['actor_name'];
							echo $actors[$i] != end($actors) ? ', ' : '';
						}
						?>
					</p>
					<p class="movie_directors movie_detail">
						<?php 
						$sql2 = "SELECT director_id FROM movie_director WHERE movie_id = {$row['movie_id']};";
						$result2 = mysqli_query($conn,$sql2);
						$directors = mysqli_fetch_all($result2);
						$directors = array_column($directors, 0) ;
						$s = count($directors) > 1 ? 's' : ''; 
						?>
						<span class="about_title">Director<?php echo $s ?>: </span>
						<?php
						for($i=0; $i<count($directors);$i++){
							$director = mysqli_fetch_assoc(mysqli_query($conn, "SELECT director_name FROM directors WHERE director_id = '{$directors[$i]}';"));
							echo $director['director_name'];
							echo $directors[$i] != end($directors) ? ', ' : '';
						}
						?>
					</p>
					<p class="movie_plot"><span class="about_title">Plot: </span><?php echo $row['movie_plot']; ?></p>
				</div>
			</div>
			<?php
			}
			}
			?>	
		</div>
	</div>
	

</body>
</html>