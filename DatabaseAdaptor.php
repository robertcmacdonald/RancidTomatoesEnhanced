 <?php

	class DatabaseAdaptor {
		// The instance variable used in every one of the functions in class DatbaseAdaptor
		private $DB;
		// Make a connection to an existing data based named 'quotes' that has
		// table quote. In this assignment you will also need a new table named 'users'
		public function __construct() {
			$db = 'mysql:dbname=Rancid;host=127.0.0.1';
			$user = 'root';
			$password = 'projectok';
			
			try {
				$this->DB = new PDO ( $db, $user, $password );
				$this->DB->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			} catch ( PDOException $e ) {
				die($e);
				exit ();
			}
		}

        // adds a newReview to the database of reviews for movies yay
		public function addNewReview($review, $author, $rating, $movieTitle){
			$stmt = $this->DB->prepare ( "INSERT INTO reviews (dateAdded, username, reviewText, reviewRating, movieTitle) values(now(), :author, :reviewText, :rating, :title)" );
            $stmt->bindParam ( 'author', $author );
            $stmt->bindParam ( 'reviewText', $review );
            $stmt->bindParam ( 'rating', $rating );
            $stmt->bindParam ( 'title', $movieTitle);
            $stmt->execute ();
		}

        public function addNewMovie($title, $year, $dir, $rating, $rTime, $bOffice, $imageLocation){
            $stmt = $this->DB->prepare("INSERT INTO movies (dateAdded, movietitle, yearReleased, director, rating, runtime, boxOffice, imageLocation) VALUES (now(), :title, :yearR, :dir, :rating, :rTime, :bOffice, :imageLocation)");
            $stmt->bindParam('title', $title);
            $stmt->bindParam('yearR', $year);
            $stmt->bindParam('dir', $dir);
            $stmt->bindParam('rating', $rating);
            $stmt->bindParam('rTime', $rTime);
            $stmt->bindParam('bOffice', $bOffice);
            $stmt->bindParam('imageLocation', $imageLocation);
            $stmt->execute();
        }

        public function getMovieByTitle($title){
            $stmt = $this->DB->prepare("SELECT * FROM movies WHERE movieTitle= 	:title");
            $stmt->bindParam('title', $title);
            $stmt->execute();
         	return $stmt->fetchAll ( PDO::FETCH_ASSOC );
        }

        public function getReviewsByTitle($title){
            $stmt = $this->DB->prepare("SELECT * FROM reviews WHERE movieTitle= :title");
            $stmt->bindParam('title', $title);
            $stmt->execute();
         	return $stmt->fetchAll ( PDO::FETCH_ASSOC );
        }




		// Return all quote records as an associative array.
		// Example code to show id and flagged columns of all records:
		// $myDatabaseFunctions = new DatabaseAdaptor();
		// $array = $myDatabaseFunctions->getQuotesAsArray();
		// foreach($array as $record) {
		// echo $record['id'] . ' ' . $record['flagged'] . PHP_EOL;
		// }
		//
		public function getQuotesAsArray() {
			// possible values of flagged are 't', 'f';
			$stmt = $this->DB->prepare ( "SELECT * FROM quote WHERE flagged='f' ORDER BY rating DESC, added" );
			$stmt->execute ();
			return $stmt->fetchAll ( PDO::FETCH_ASSOC );
		}
		
		// Insert a new quote into the database
		public function addNewQuote($quote, $author) {
			$stmt = $this->DB->prepare ( "INSERT INTO quote (added, quote, author, rating, flagged ) values(now(), :quote, :author, 0, 'f')" );
			$stmt->bindParam ( 'quote', $quote );
			$stmt->bindParam ( 'author', $author );
			$stmt->execute ();
		}
		
		// Raise the rating of the quote with the given $ID by 1
		public function raiseRating($ID) {
			$stmt = $this->DB->prepare ( "UPDATE quote SET rating=rating+1 WHERE id= :ID" );
			$stmt->bindParam ( 'ID', $ID );
			$stmt->execute ();
		}
		
		// Lower the rating of the quote with the given $ID by 1
		public function lowerRating($ID) {
			$stmt = $this->DB->prepare ( "UPDATE quote SET rating=rating-1 WHERE id= :ID" );
			$stmt->bindParam ( 'ID', $ID );
			$stmt->execute ();
		}
		
		// Set the 'flagged' column of one particular quote to 't' so it will not
		// be shown in the quote collection, until all quotes are unflagged later.
		public function flag($ID) {
			$stmt = $this->DB->prepare ( "UPDATE quote SET flagged = 't' WHERE id= :ID" );
			$stmt->bindParam ( 'ID', $ID );
			$stmt->execute ();
		}
		
		// Used for testing only so far on 9-Nov-2015
		public function isFlagged($ID) {
			$stmt = $this->DB->prepare ( "SELECT * FROM quote WHERE id= :ID" );
			$stmt->bindParam ( 'ID', $ID );
			$stmt->execute ();
			$currentRecord = $stmt->fetch ();
			return $currentRecord ['flagged'] === 't';
		}
		
		// Used for testing only so far on 9-Nov-2015
		public function removeAllDuckTypedRecords() {
			$stmt = $this->DB->prepare ( "DELETE FROM users WHERE username LIKE '%duckTyped%'" );
			$stmt->execute ();
		}
		
		// Change all quote records such that the flagged column is 'f' for every one
		public function unflagAll() {
			// TODO: Complete this function
			$stmt = $this->DB->prepare ( "UPDATE quote SET flagged = 'f'" );
			$stmt->execute ();
		}
		
		// Add a new user with the given $username and the plain text $password, that will be used in the
		// PHP function password_hash. Before you register new users, you will need this table added to your
		// data base. Run this in mysql (MariaDB) from the command line after the sql command USE quotes:
		//

		public function register($username, $password) {
			$hash = password_hash ( $password, PASSWORD_DEFAULT );
			$sth = $this->DB->prepare ( "INSERT INTO reviewers (username, passhash) VALUES ( :username, :hash);" );
			$sth->bindParam ( ':username', $username );
			$sth->bindParam ( ':hash', $hash );
			$sth->execute ();
		}
		
		// Return TRUE if the given $username has a plain text $password that works with
		// the hash value stored for that user. You need the PHP function password_verify
		// to do this.
		public function verified($username, $password) {
			$stmt = $this->DB->prepare ( 'SELECT passhash FROM reviewers WHERE username = :username' );
			$stmt->bindParam ( ':username', $username );
			$stmt->execute ();
			$user = $stmt->fetch ();
			
			// Hashing the password with its hash as the salt returns the same hash
			if (password_verify ( $password, $user ['passhash'] ))
				return TRUE;
			else
				return FALSE;
		}
		
		// Return TRUE if the given $username has mot been taken in the database
		public function canRegister($username) {
			$stmt = $this->DB->prepare ( 'SELECT * FROM reviewers WHERE username = :username' );
			$stmt->bindParam ( ':username', $username );
			$stmt->execute ();
			$stmt->fetch ();
			
			// Hashing the password with its hash as the salt returns the same hash
			if ($stmt->rowCount () === 0)
				return TRUE;
			else
				return FALSE;
		}
	} // end class DatabaseAdaptor
	
	$myDatabaseFunctions = new DatabaseAdaptor ();
	
	// Test code can only be used temporaily here. If kept, deleting account 'fourth' from anywhere would 
	// cause these asserts to generate error messages. And when did you find out 'fourth' is registered?
	// assert ( $myDatabaseFunctions->verified ( 'fourth', '4444' ) );
	// assert ( ! $myDatabaseFunctions->canRegister ( 'fourth' ) );
	?>