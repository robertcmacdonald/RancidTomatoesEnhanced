CREATE DATABASE IF NOT EXISTS Rancid;
USE Rancid;
CREATE TABLE IF NOT EXISTS movies(
    id int AUTO_INCREMENT, 
    dateAdded datetime,
    movieTitle varchar(255),
    yearReleased varchar(255),
    director varchar(255),
    rating int,
    runtime int,
    boxOffice int,
    imageLocation varchar(255),
    PRIMARY KEY (`id`)
);
CREATE TABLE IF NOT EXISTS reviewers (
    id int AUTO_INCREMENT,
    username varchar(255),
    passhash varchar(255),
    firstname varchar(255),
    lastname varchar(255),
    publication varchar(255),
    PRIMARY KEY (`id`)
);
CREATE TABLE IF NOT EXISTS reviews (
    id int AUTO_INCREMENT,
    dateAdded datetime,
    username varChar(255),
    firstname varChar(255),
    lastname varChar(255),
    publication varChar(255),
    reviewText varChar(255),
    reviewRating varChar(255),
    movieTitle varChar(255),
    PRIMARY KEY (`id`)
);
INSERT INTO movies (dateAdded, movietitle, yearReleased, director, rating, runtime, boxOffice)
    VALUES (now(), 'Movie 1', '2011', 'one', 0, 181, 0);
INSERT INTO movies (dateAdded,movieTitle, yearReleased, director, rating, runtime, boxOffice)
    VALUES (now(),'Movie 2', '2012', 'two', 1, 182, 0);
INSERT INTO movies (dateAdded,movieTitle, yearReleased, director, rating, runtime, boxOffice)
    VALUES (now(),'Movie 3', '2013', 'three', 2, 183, 0);
INSERT INTO movies (dateAdded,movieTitle, yearReleased, director, rating, runtime, boxOffice)
    VALUES (now(),'Movie 4', '2014', 'four', 3, 184, 0);
INSERT INTO movies (dateAdded,movieTitle, yearReleased, director, rating, runtime, boxOffice)
    VALUES (now(),'Movie 5', '2015', 'five', 1, 185, 0);
INSERT INTO reviews (dateAdded, username, reviewText, reviewRating, movieTitle )
    VALUES (now(),'allan', 'movie 1 sucks', 'r', 'Movie 1');  
INSERT INTO reviews (dateAdded, username, reviewText, reviewRating, movieTitle )
    VALUES (now(),'allan', 'movie 2 doesnt suck', 'f', 'Movie 2');  
INSERT INTO reviews (dateAdded, username, reviewText, reviewRating, movieTitle )
    VALUES (now(),'allan', 'movie 3 sucks', 'r', 'Movie 3');  
INSERT INTO reviews (dateAdded, username, reviewText, reviewRating, movieTitle )
    VALUES (now(),'allan', 'movie 4 doesnt suck', 'f', 'Movie 4');  
INSERT INTO reviews (dateAdded, username, reviewText, reviewRating, movieTitle )
    VALUES (now(),'allan', 'movie 5 sucks', 'r', 'Movie 5');  
