<!DOCTYPE HTML>
<html>
<head>
    <title>Rancid Tomatoes</title>
    <link rel="stylesheet" href="movie.css">
    <meta charset="utf-8" />
</head>
<body>
	<ul id='navbarUL'>
		<li class='navbarItem'><a href="search.php">Search for a movie</a></li>
		<li class='navbarItem'><a href="index.php">Home</a></li>
		<?php 
			session_start ();
			if (isset ( $_SESSION ["user"] )) {
		?>
			<li class='navbarItem'><a href="logout.php">Logout</a></li>
			<li class='navbarItem'><a href="newReview.php">Add new review</a></li>
			<li class='navbarItem'><a href="newMovie.php">Add new movie</a></li>
		<?php
			} else {
		?>
			<li class='navbarItem'><a href="login.php">Login or register</a></li>
		<?php
			}
		?>
	</ul>
	<h2>Newest movies</h2>
	<h2>Newest reviews</h2>
</body>
</html>