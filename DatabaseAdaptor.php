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
		public function addNewReview($review, $username, $firstname, $lastname, $publication, $rating, $movieTitle){
			$stmt = $this->DB->prepare ( "INSERT INTO reviews (dateAdded, username, firstname, lastname, publication, reviewText, reviewRating, movieTitle)" 
				. "values(now(), :username, :firstname, :lastname, :publication, :reviewText, :rating, :title)" );
            $stmt->bindParam ( 'username', $username );
            $stmt->bindParam ( 'firstname', $firstname );
            $stmt->bindParam ( 'lastname', $lastname );
            $stmt->bindParam ( 'publication', $publication );
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

        public function getMovies($title) {
    		$stmt = $this->DB->prepare("SELECT * FROM movies WHERE movieTitle LIKE BINARY '%$title%'");
   			$stmt->execute();
    		return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

        public function getLatestMovies() {
        	$stmt = $this->DB->prepare("SELECT * FROM movies ORDER BY id DESC LIMIT 12");
        	$stmt->execute();
        	return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getLatestReviews() {
        	$stmt = $this->DB->prepare("SELECT * FROM reviews ORDER BY id DESC LIMIT 8");
        	$stmt->execute();
        	return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
		
		public function isValidTitle($title){
			$stmt = $this->DB->prepare("SELECT 1 FROM movies WHERE movieTitle= :title");
			$stmt->bindParam('title', $title);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return count($result) > 0;
		}

		public function getAuthorInfo($author) {
			$stmt = $this->DB->prepare("SELECT * FROM reviewers WHERE username= :author");
			$stmt->bindParam('author', $author);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		// Add a new user with the given $username and the plain text $password, that will be used in the
		// PHP function password_hash. Before you register new users, you will need this table added to your
		// data base. Run this in mysql (MariaDB) from the command line after the sql command USE quotes:
		//

		public function register($firstname, $lastname, $publication, $username, $password) {
			$hash = password_hash ( $password, PASSWORD_DEFAULT );
			$sth = $this->DB->prepare ( "INSERT INTO reviewers (username, passhash, firstname, lastname, publication)"   
					. "VALUES ( :username, :hash, :firstname, :lastname, :publication);" );
			$sth->bindParam ( ':username', $username );
			$sth->bindParam ( ':hash', $hash );
			$sth->bindParam ( ':firstname', $firstname );
			$sth->bindParam ( ':lastname', $lastname );
			$sth->bindParam ( ':publication', $publication );
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

	?>