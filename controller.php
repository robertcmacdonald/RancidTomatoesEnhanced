<?php
// This file contains a bridge between the view and the model and redirects back to the proper page 
// with after processing whatever form this codew absorbs.  This is the C in MVC, the Controller.
//
// Authors: Rick Mercer and Hassanain Jamal
//
require './DataBaseAdaptor.php';

if (isset ( $_POST ['username'] ) && isset ( $_POST ['password'] )) {
	$username = $_POST ['username'];
	$password = $_POST ['password'];
	session_start (); // Do this in every file before accessing $_SESSION (bad name?)
	if (isset ( $_POST ['login'] )) {
		if ($myDatabaseFunctions->verified ( $username, $password )) {
			// Store Session Data
			$_SESSION ['user'] = $username;
			header ( "Location: ./index.html" );
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
			header ( "Location: ./index.html" );
		} else {
			$_SESSION['registerError'] = 'Username already in use';
			header ("Location: ./register.php");
		}
	}
} elseif (isset ( $_POST ['logout'] )) {
	session_start (); // to ensure you are using same session
	session_destroy (); // destroy the session so $SESSION['anything'] is not set
	header ( "Location: index.html" );
} elseif (isset ( $_POST ['addMovie'] )) {
    $title = $_POST ['title'];
    $year = $_POST ['year'];
    $dir = $_POST ['director'];
    $rating = $_POST ['rating'];
    $rTime = $_POST ['runtime'];
    $bOffice = $_POST ['boxOffice'];
    // TODO: add image into this call somehow
    $myDatabaseFunctions->addNewMovie($title, $year, $dir, $rating, $rTime, $bOffice );

    //TODO: change this to load the new review page just made from call
    header("Location: review.php");

} elseif (isset ( $_POST ['newReview'] )) {
    //TODO: determine how to get movieTitle from reviewForm
    // when we press add review button somehow pass the movie title to the form page?
	$author = $_POST ['name'];
	$review = $_POST ['reviewer'];
    $rating = $_POST['rating'];
	$myDatabaseFunctions->addNewReview( $review, $author, $rating, $movieTitle );
	header ( "Location: quotes.php" );
} 
?>