<?php
// This file contains a bridge between the view and the model and redirects back to the proper page 
// with after processing whatever form this codew absorbs.  This is the C in MVC, the Controller.
//
// Authors: Rick Mercer and Hassanain Jamal
//
require './DatabaseAdaptor.php';

if (isset ( $_POST ['username'] ) && isset ( $_POST ['password'] )) {
	$username = $_POST ['username'];
	$password = $_POST ['password'];
	session_start (); // Do this in every file before accessing $_SESSION (bad name?)
	if (isset ( $_POST ['login'] )) {
		if ($myDatabaseFunctions->verified ( $username, $password )) {
			// Store Session Data
			$_SESSION ['user'] = $username;
			$_SESSION['loginError'] = '';
			header ( "Location: ./index.php" );
		} else {
			$_SESSION ['loginError'] = 'Invalid Account/Password';
			header ( "Location: ./login.php" );
		}
	} else if (isset ( $_POST ['register'] )) {
		// TODO Change this to use $myDatabaseFunctions->canRegister($userName) so no
		// two accounts can have the same account name. And if the requested
		// accountname is in the database, tell the user so using an $_SESSION variable.
		if ($myDatabaseFunctions->canRegister($username)) {
			$myDatabaseFunctions->register ( $username, $password );
			$_SESSION['registerError'] = '';
			header ( "Location: ./index.php" );
		} else {
			$_SESSION['registerError'] = 'Username already in use';
			header ("Location: ./register.php");
		}
	}
} elseif (isset ( $_POST ['logout'] )) {
	session_start (); // to ensure you are using same session
	session_destroy (); // destroy the session so $SESSION['anything'] is not set
	header ( "Location: index.php" );
} elseif (isset ( $_POST ['addMovie'] )) {
    $title = $_POST ['title'];
    $year = $_POST ['year'];
    $dir = $_POST ['director'];
    $rating = $_POST ['rating'];
    $rTime = $_POST ['runtime'];
    $bOffice = $_POST ['boxOffice'];

    if (!isset($_FILES['movieImage']['error']) || $_FILES['movieImage']['error'] !== UPLOAD_ERR_OK)
    	die("Upload failed with error");
    if (!isImage($_FILES['movieImage']['tmp_name']))
    	die("Must upload an image file.");
    $imageLocation = './images/' . $title . '.jpg';
    move_uploaded_file($_FILES['movieImage']['tmp_name'], $imageLocation);
    $myDatabaseFunctions->addNewMovie($title, $year, $dir, $rating, $rTime, $bOffice, $imageLocation );

    //TODO: change this to load the new review page just made from call
    header("Location: reviewPage.php?movieTitle=" . $title);

} elseif (isset ( $_POST ['newReview'] )) {
    //TODO: determine how to get movieTitle from reviewForm
    // when we press add review button somehow pass the movie title to the form page?
	$author = $_POST ['author'];
	$review = $_POST ['reviewText'];
    $rating = $_POST['rating'];
    $movieTitle = $_POST['movieTitle'];
	$myDatabaseFunctions->addNewReview( $review, $author, $rating, $movieTitle );
	header ( "Location: reviewPage.php?movieTitle=" . $movieTitle );
} 

function constructReviews($reviews) {
	$i = 0;
	$columnOne = "<div class='column_one'>";
	$columnTwo = "<div class='column_two'>";
	foreach ($reviews as $review) {
		$str = '<div class="review">' . 
                    '<div class="review_text">' . 
                        '<p>';
        if ($review['reviewRating'] == 'f') {
        	$str .= '<img src="./images/fresh.gif" alt="Fresh" />';
        } else {
        	$str .= '<img src="./images/rotten.gif" alt="Rotten" />';
        }
        $str .= '<q>' . $review['reviewText'] . '</q>' . 
                '</p></div><div class="reviewer_name"><p>' .
                    '<img src="images/critic.gif" alt="critic" />' . $review['username'] . '<br>' . 
               '<p></div></div>';
		if ($i % 2 == 0) {
			$columnOne .= $str;
		} else {
			$columnTwo .= $str;	
		}
		$i++;
	}
	return $columnOne . '</div>' . $columnTwo . '</div>';
}

function freshOrNot($reviews) {
	$rottenCount = 0.0;
	$freshCount = 0.0;
	foreach ($reviews as $review) {
		if ($review['reviewRating'] == 'f') {
			$freshCount++;
		} else {
			$rottenCount++;
		}
	}
	if ($rottenCount + $freshCount == 0) {
		return 'No reviews yet!';
	}
	$ratingHeader = intval(($freshCount / ($rottenCount + $freshCount)) * 100);
	if ($ratingHeader >= 60) {
		return "<img src='images/freshlarge.png' alt='Fresh' />" . $ratingHeader . "%"; 
	} else {
		return "<img src='images/rottenlarge.png' alt='Rotten' />" . $ratingHeader . "%";
	}
}

function isImage($image){
	return getimagesize($image) > 0;
}
?>