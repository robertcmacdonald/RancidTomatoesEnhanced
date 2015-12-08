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

<div id="loginDiv">
	<form action="controller.php" method="post">
		<table id="loginTable">
			<tr>
				<td>Username:</td> 
				<td><input type="text" name="username" required></td>
			</tr>
			<tr>
				<td>Password:</td> 
				<td><input type="password" name="password" required></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="login" value="Login"></td>
			</tr>
		</table>
	</form>
	<a href="register.php">New user? Register here!</a>
</div>


<?php
	if (isset($_SESSION ['loginError'])) {
		echo $_SESSION ['loginError'];
		$_SESSION['loginError'] = "";
	}
?>
