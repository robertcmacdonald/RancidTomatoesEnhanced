<html>
<head>
    <title>Rancid Tomatoes</title>
    <link rel="stylesheet" href="movie.css">
    <meta charset="utf-8" />
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
</body>
</html>

<?php
	if (isset($_SESSION['reviewError'])) {
		echo $_SESSION['reviewError'];
		$_SESSION['reviewError'] = "";
	}
?>

<form action="controller.php" method="post" id="reviewForm">
	Movie Title: <input type="text" name="movieTitle" required> <br>
	Review:<br><textarea rows="4" cols="80" name="reviewText" placeholder="Write review here" required></textarea>
	<br>
    <input type="radio" name="rating" value="f" required>Fresh
    <input type="radio" name="rating" value="r" required>Rotten<br>
    <input type="hidden" name="author" value="<?= $_SESSION['user']?>" required><br>

    <input type="submit" name="newReview" value="Submit">
</form>
<button type="button" onclick="window.location.href='index.php'">Cancel</button>
