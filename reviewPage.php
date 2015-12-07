<!DOCTYPE html>
<!--Cody Macdonald
    CSc 337 Assignment 5
    This PHP file contains the information that is displayed on the RancidTomatoes web page.
    This is a modified version of tmnt.html from assignment 2. Much of the original HTML
    remains, but some has been replaced with PHP code in order to display dynamic content.
-->
<html>
<head>
    <title>Rancid Tomatoes</title>
    <link rel="stylesheet" href="movie.css">
    <meta charset="utf-8" />
    <?php  // Load functions from functions.php file
    ?>
</head>

<body>
	<div class="banner_background">
        <div class="banner">
            <img src="images/rancidbanner.png" alt="Rancid Tomatoes">
        </div>
	</div>
    <?php
    	require './controller.php';
    	require_once('./DatabaseAdaptor.php');
        $movie = $_GET["movieTitle"];
        $movieInfo = $myDatabaseFunctions->getMovieByTitle($movie);
        $movieInfo = $movieInfo[0];
        $movieReviews = $myDatabaseFunctions->getReviewsByTitle($movie);
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
                <?= '<img src="' . $movieInfo['imageLocation'] . '" alt="general overview" />' ?>
            </div>
            <dl>
            	<dt>Director</dt>
            		<?= '<dd>' . $movieInfo['director'] . '</dd>' ?>
            	<dt>Rating</dt>
            		<?= '<dd>' . $ratings_array[$movieInfo['rating']] . '</dd>' ?>
            	<dt>Runtime</dt>
            		<?= '<dd>' . $movieInfo['runtime'] . '</dd>' ?>
            	<dt>Box office</dt>
            		<?= '<dd>' . $movieInfo['boxOffice'] . '</dd>' ?>
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
