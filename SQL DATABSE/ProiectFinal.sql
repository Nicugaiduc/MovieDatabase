
create database movies;
use movies;

create table administrator(
	admin_id int(11) not null auto_increment,
    admin_name varchar(50) not null,
    admin_password varchar(20) not null,
    primary key(admin_id)
);

create table users(
	user_id int(11) not null auto_increment primary key,
    user_name tinytext not null,
    user_mail tinytext not null,
    user_password longtext not null
);
drop table users;

create table directors(
	director_id int(11) not null auto_increment primary key,
    director_name varchar(50) null unique
);

create table actors(
	actor_id int(11) not null auto_increment primary key,
    actor_name varchar(50) null unique
);

create table genres(
	genre_id int(11) not null auto_increment primary key,
    genre_name varchar(50) null unique
);

create table movies(
	movie_id int(11) not null auto_increment primary key,
    movie_title varchar(50) not null,
    movie_year int(11) not null,
    movie_runtime varchar(11) not null,
    movie_image varchar(200),
    movie_plot varchar(400) not null
);

create table movie_director(
	movie_id int(11) not null,
    director_id int(11) not null,
    FOREIGN KEY (movie_id) REFERENCES movies(movie_id),
    FOREIGN KEY (director_id) REFERENCES directors(director_id)
);

create table movie_actor(
	movie_id int(11) not null,
    actor_id int(11) not null,
    FOREIGN KEY (movie_id) REFERENCES movies(movie_id),
    FOREIGN KEY (actor_id) REFERENCES actors(actor_id)
);

create table movie_genre(
	movie_id int(11) not null,
    genre_id int(11) not null,
    FOREIGN KEY (movie_id) REFERENCES movies(movie_id),
    FOREIGN KEY (genre_id) REFERENCES genres(genre_id)
);

create table chestionar_user(
	intrebare_id int(11) not null auto_increment primary key,
    user_id int(11) not null,
    intrebare varchar(50) not null,
    raspuns varchar (50) default null,
    FOREIGN KEY(user_id) REFERENCES users(user_id)
);

CREATE VIEW movie_plot AS
SELECT movie_title, movie_plot
FROM movies;

CREATE VIEW movie_year AS
SELECT movie_title, movie_year
FROM movies;

CREATE VIEW movie_actors AS
SELECT movie_title, group_concat(actor_name) AS Actors
FROM  movies
join movie_actor on movies.movie_id = movie_actor.movie_id
join actors on movie_actor.actor_id = actors.actor_id
group by movie_title;

CREATE VIEW movie_derectors AS
SELECT movie_title, movie_year, GROUP_CONCAT(director_name) AS Directors
FROM movies
JOIN movie_director ON movies.movie_id = movie_director.movie_id
JOIN directors ON movie_director.director_id = directors.director_id
group by movie_title;

CREATE VIEW movie_genres AS
SELECT movie_title, movie_year, GROUP_CONCAT(genre_name) AS Genres
FROM movies
JOIN movie_genre ON movies.movie_id = movie_genre.movie_id
JOIN genres ON movie_genre.genre_id = genres.genre_id
GROUP BY movie_title;

-ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff
delimiter //
create definer=root@localhost procedure init_chestionar(user_id integer)
begin
insert into chestionar_user(user_id,intrebare,raspuns) values
(user_id,'Ce varsta aveti?',null),
(user_id,'Care este filmul dumneavoastra preferat?',null);
end//

create definer='root'@'localhost'
	trigger user_chestionar
    after insert on users
		for each row call init_chestionar(new.user_id);
        
--fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff
delimiter //
create definer='root'@'localhost'
trigger movies.adaugare_URL
before insert on movies.movies for each row
begin
	if(new.movie_image is null or new.movie_image = '') then
    set new.movie_image = 'https://www.citypages.com/img/movie-placeholder.gif';
    end if;
end;//

delimiter //
create procedure preia_user()
begin
select user_name, user_mail
from users;
end;//

--FUNCTIONS FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF

delimiter //
CREATE FUNCTION get_year(date1 int) RETURNS int deterministic
BEGIN
	
	DECLARE date2 int;
    Select YEAR(CURDATE()) into date2;
    RETURN date2 - date1;
END;//
SELECT movie_title, get_year(movie_year) as Years FROM movies;

delimiter //
CREATE FUNCTION get_hour(minutes int) RETURNS varchar(50) deterministic
BEGIN 
	DECLARE h int;
    DECLARE m int;
    SELECT FLOOR(minutes/60) into h;
    SELECT MOD(minutes, 60) into m;
    RETURN concat(h, " ore si ", m, " minute") ;    
END; 
SELECT movie_title, get_hour(movie_runtime) from movies;





