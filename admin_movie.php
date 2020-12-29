<?php
		if(isset($_POST['submit'])){
			include_once 'sql_connect.php';

			$movie_title = $_POST['movie_title'];
			$movie_year = $_POST['movie_year'];
			$movie_runtime = $_POST['movie_runtime'];
			$movie_genre = $_POST['movie_genre'];	
			$movie_actors = $_POST['movie_actors'];
			$movie_director = $_POST['movie_director'];
			$movie_plot = $_POST['movie_plot'];
			$movie_image = $_POST['movie_image'];
			$data = array();

			$data['title'] = $movie_title;
			$data['year'] = $movie_year;
			$data['runtime'] = $movie_runtime;
			$data['genre'] =$movie_genre = explode(",",implode(", ",$movie_genre)); //= explode(",",implode(",",$movie_genre));
			$data['actors'] = $movie_actors = explode(",",implode(", ",$movie_actors));
			$data['director'] = $movie_director = explode(",",implode(", ",$movie_director));
			$data['plot'] = mysqli_escape_string($conn, $movie_plot);
			$data['url'] = $movie_image;

			//print_r($data);
			$sql = "INSERT IGNORE INTO movies (movie_title, movie_year, movie_runtime, movie_image, movie_plot) VALUES ('{$data['title']}', '{$data['year']}', '{$data['runtime']}', '{$data['url']}', '{$data['plot']}');";
				mysqli_query($conn, $sql);
				$movie_id = mysqli_insert_id($conn);

			for($i=0;$i<count($movie_director);$i++){
				$director = mysqli_escape_string($conn,trim($movie_director[$i]));
				$sql = "INSERT IGNORE INTO directors(director_name) VALUES ('$director');";
				mysqli_query($conn, $sql);
				$director_id = mysqli_insert_id($conn);

				if($director_id){
					$sql = "INSERT INTO movie_director (movie_id, director_id) VALUES ('$movie_id', '$director_id');";
					mysqli_query($conn, $sql);
				}
				else{
					$sql = "SELECT director_id FROM directors WHERE director_name = '$director';";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($result);
					$director_id = $row['director_id'];

					$sql = "INSERT INTO movie_director (movie_id, director_id) VALUES ('$movie_id', '$director_id');";
					mysqli_query($conn, $sql);
				}
			}
			for($i=0;$i<count($movie_actors);$i++){
				$actor = mysqli_escape_string($conn,trim($movie_actors[$i]));
				$sql = "INSERT IGNORE INTO actors(actor_name) VALUES ('$actor');";
				mysqli_query($conn, $sql);
				$actor_id = mysqli_insert_id($conn);


				if($actor_id){
					$sql = "INSERT INTO movie_actor (movie_id, actor_id) VALUES ('$movie_id', '$actor_id');";
					mysqli_query($conn, $sql);
				}
				else{
					$sql = "SELECT actor_id FROM actors WHERE actor_name = '$actor';";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($result);
					$actor_id = $row['actor_id'];

					$sql = "INSERT INTO movie_actor (movie_id, actor_id) VALUES ('$movie_id', '$actor_id');";
					mysqli_query($conn, $sql);
				}
			}
			for($i=0;$i<count($movie_genre);$i++){
				$genre = mysqli_escape_string($conn,trim($movie_genre[$i]));
				$sql = "INSERT IGNORE INTO genres(genre_name) VALUES ('$genre');";
				mysqli_query($conn, $sql);
				$genre_id = mysqli_insert_id($conn);

					

				if($genre_id){
					$sql = "INSERT INTO movie_genre (movie_id, genre_id) VALUES ('$movie_id', '$genre_id');";
					mysqli_query($conn, $sql);
				}
				else{
					$sql = "SELECT genre_id FROM genres WHERE genre_name = '$genre';";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($result);
					$genre_id = $row['genre_id'];

					$sql = "INSERT INTO movie_genre (movie_id, genre_id) VALUES ('$movie_id', '$genre_id');";
					mysqli_query($conn, $sql);
				}
			}
			header("Location: admin_add_movie.php?adaugare=succes");	
	}
	else{
		header("Location: admin_add_movie.php?adaugare=faild");
	}
?>