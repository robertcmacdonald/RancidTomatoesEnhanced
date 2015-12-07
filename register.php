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
</body>
</html>

<?php
	if (isset($_SESSION ['registerError'])) {
		echo $_SESSION ['registerError'];
		$_SESSION['registerError'] = "";
	}
?>

<form action="controller.php" method="post">
	First name: <input type="text" name="firstname" required><br>
	Last name: <input type="text" name="lastname" required><br>
	Publication: <input type="text" name="publication" required><br>
	Username: <input type="text" name="username" required><br>
	Password (at least 8 characters): <input type="password" name="password" pattern=".{8,}" required><br>
	<input type="submit" name="register" value="Login">
</form>