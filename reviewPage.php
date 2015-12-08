<!DOCTYPE html>

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
        <li class='navbarItem'><a href="search.php">Search Movies</a></li>
        <?php 
            session_start ();
            if (isset ( $_SESSION ["user"] )) {
        ?>
            <li class='navbarItem'><a href="newReview.php">Add New Review</a></li>
            <li class='navbarItem'><a href="newMovie.php">Add New Movie</a></li>
            <li class='navbarItem'><a href="logout.php">Log Out</a></li>
            <li class='navbarItem'><a href="newReview.php?movie=<?= $_GET['movieTitle'] ?>">Add Review For This Movie!</a></li>
        <?php
            } else {
        ?>
            <li class='navbarItem'><a href="login.php">Login or register</a></li>
        <?php
            }
        ?>
    </ul>
    <?php
    	require './controller.php';
        $movie = $_GET["movieTitle"];
        $movieInfo = getMovie($movie);
        $movieInfo = $movieInfo[0];
        $movieReviews = getReviewsForMovie($movie);
        $ratings_array = ['G', 'PG', 'PG-13', 'R'];
    ?>
	<h1 class="text_heading"><?= $movieInfo['movieTitle'] . " " . $movieInfo['yearReleased'] ?></h1>

    <div class="content_area">
        <div class="reviews_heading">
            <?= // Load correct image based on rating of movie
                // Display rating next to loaded image
                freshOrNot($movieReviews);
            ?>
        </div>
        <div class="reviews">
            <?= // Construct review columns
                constructReviews($movieReviews);
            ?>
        </div>
        <div class="general_overview">
            <div id="overview_image">
                <?= '<img src="' . $movieInfo['imageLocation'] . '" id="overviewImg" alt="general overview" />' ?>
            </div>
            <dl>
            	<dt>Director</dt>
            		<?= '<dd>' . $movieInfo['director'] . '</dd>' ?>
            	<dt>Rating</dt>
            		<?= '<dd>' . $ratings_array[$movieInfo['rating']] . '</dd>' ?>
            	<dt>Runtime</dt>
            		<?= '<dd>' . $movieInfo['runtime'] . ' minutes</dd>' ?>
            	<dt>Box office</dt>
            		<?= '<dd>$' . $movieInfo['boxOffice'] . ' million</dd>' ?>
            </dl>
        </div>
        <footer class="page_footer">
            <div class="footer_text">
            </div>
        </footer>
        <div class="reviews_heading">
            <?= // Load correct image based on rating of movie
                // Display rating next to loaded image
                freshOrNot($rating) . " " . $rating . "%";
            ?>
        </div>
    </div>


</body>
</html>
