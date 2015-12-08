<!DOCTYPE HTML>
<html>
<head>
    <title>Rancid Tomatoes</title>
    <link rel="stylesheet" href="movie.css">
    <link rel="shortcut icon" href="images/favicon.ico">
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
        <li class='navbarItem'><a href="search.php">Search Movies</a></li>
        <?php 
            session_start ();
            if (isset ( $_SESSION ["user"] )) {
        ?>
            <li class='navbarItem'><a href="newReview.php">Add New Review</a></li>
            <li class='navbarItem'><a href="newMovie.php">Add New Movie</a></li>
            <li class='navbarItem'><a href="logout.php">Log Out</a></li>
        <?php
            } else {
        ?>
            <li class='navbarItem'><a href="login.php">Login or register</a></li>
        <?php
            }
        ?>
	</ul>
	<div class="topTenColMovies">
	<div id="newMovies">
		<h2 style="font-family:Verdana;">Newest Movies</h2>
			<?= getNewestMovies() ?>
	</div>
	</div>
	<div class="topTenColReviews">
	<div id="newReviews">
		<h2 style="text-align:center; font-family:Verdana;">Newest Reviews</h2>
			<?= getNewestReviews() ?>
	</div>
	</div>
</body>
</html>