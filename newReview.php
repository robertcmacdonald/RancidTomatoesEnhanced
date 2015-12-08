<html>
<head>
    <title>Rancid Tomatoes</title>
    <link rel="stylesheet" href="movie.css">
    <link rel="shortcut icon" href="images/favicon.ico">
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
</body>
</html>

<?php
	$movieName='';
	if (isset($_GET['movie'])) {
		$movieName=$_GET['movie'];
	} 
?>

<div id="newReviewDiv">
	<form action="controller.php" method="post" id="reviewForm">
		<table id="newReviewTable">
			<tr>
				<td>Movie Title: </td> 
				<td><input type="text" name="movieTitle" value="<?= $movieName ?>" required> </td>
			</tr>
			<tr>
				<td>Review: </td>
				<td><textarea rows="4" cols="80" name="reviewText" placeholder="Write review here" required></textarea></td>
			</tr>
			<tr>
				<td></td>
	    		<td><input type="radio" name="rating" value="f" required>     Fresh</td>
    		</tr>
    		<tr>
				<td></td>
	    		<td><input type="radio" name="rating" value="r" required>     Rotten</td>
    		</tr>
    		<input type="hidden" name="author" value="<?= $_SESSION['user']?>" required><br>
			<tr>
				<td></td>
				<td><input type="submit" name="newReview" value="Submit">
				<button type="button" onclick="window.location.href='index.php'">Cancel</button></td>
			</tr>
		</table>
	</form>
</div>

<?php
	if (isset($_SESSION['reviewError'])) {
		echo $_SESSION['reviewError'];
		$_SESSION['reviewError'] = "";
	}
?>
