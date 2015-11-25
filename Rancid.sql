CREATE DATABASE IF NOT EXISTS Rancid;
USE Rancid;
CREATE TABLE IF NOT EXISTS movies(
    id int AUTO_INCREMENT, 
    added datetime,
    movieTitle varChar(255) UNIQUE,
    year YEAR(),
    director varChar(255);
    rating SMALLINT(),
    runtime SMALLINT(),
    boxOffice int(),
    imageLocation varChar(255)
);
CREATE TABLE IF NOT EXISTS reviewers (
    id int AUTO_INCREMENT,
    username varChar(255) UNIQUE,
    passhash varChar(255),
);
CREATE TABLE IF NOT EXISTS reviews (
    id int AUTO_INCREMENT,
    added datetime,
    username varChar(255),
    reviewText TINYTEXT(),
    reviewRating CHAR(1),
    movieTitle varChar(255)
);
INSERT INTO movies (added, movietitle, year, director, rating, runtime, boxOffice)
    VALUES (now(), 'Movie 1', 2011, 'one', 0, 181, 0);
INSERT INTO movies (added,movieTitle, year, director, rating, runtime, boxOffice)
    VALUES (now(),'Movie 2', 2012, 'two', 1, 182, 0);
INSERT INTO movies (added,movieTitle, year, director, rating, runtime, boxOffice)
    VALUES (now(),'Movie 3', 2013, 'three', 2, 183, 0);
INSERT INTO movies (added,movieTitle, year, director, rating, runtime, boxOffice)
    VALUES (now(),'Movie 4', 2014, 'four', 3, 184, 0);
INSERT INTO movies (added,movieTitle, year, director, rating, runtime, boxOffice)
    VALUES (now(),'Movie 5', 2015, 'five', 1, 185, 0);
INSERT INTO reviews (added, username, reviewText, reviewRating, movieTitle )
    VALUES (now(),'allan', 'movie 1 sucks', 'r', 'Movie 1');  
INSERT INTO reviews (added, username, reviewText, reviewRating, movieTitle )
    VALUES (now(),'allan', 'movie 2 doesnt suck', 'f', 'Movie 2');  
INSERT INTO reviews (added, username, reviewText, reviewRating, movieTitle )
    VALUES (now(),'allan', 'movie 3 sucks', 'r', 'Movie 3');  
INSERT INTO reviews (added, username, reviewText, reviewRating, movieTitle )
    VALUES (now(),'allan', 'movie 4 doesnt suck', 'f', 'Movie 4');  
INSERT INTO reviews (added, username, reviewText, reviewRating, movieTitle )
    VALUES (now(),'allan', 'movie 5 sucks', 'r', 'Movie 5');  
