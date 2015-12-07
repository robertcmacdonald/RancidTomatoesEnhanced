<!DOCTYPE HTML>
<html>
<head>
    <title>Rancid Tomatoes</title>
    <link rel="stylesheet" href="movie.css">
    <meta charset="utf-8" />
    <?php require_once("controller.php"); ?>
</head>
<body>
	<div class="banner_background">
    <div class="banner">
        <img src="images/rancidbanner.png" alt="Rancid Tomatoes">
    </div>
	</div>
	<ul id='navbarUL'>
		<li class='navbarItem'><a href="index.php">Home</a></li>
        <li class='navbarItem'><a href="search.php">Search for a movie</a></li>
		<?php 
			session_start ();
			if (isset ( $_SESSION ["user"] )) {
		?>
			<li class='navbarItem'><a href="newReview.php">Add new review</a></li>
            <li class='navbarItem'><a href="newMovie.php">Add new movie</a></li>
            <li class='navbarItem'><a href="logout.php">Logout</a></li>
		<?php
			} else {
		?>
			<li class='navbarItem'><a href="login.php">Login or register</a></li>
		<?php
			}
		?>
	</ul>
	<h2>Newest movies</h2>
		<?= getNewestMovies() ?>
	<h2>Newest reviews</h2>
		<?= getNewestReviews() ?>
</body>
</html>