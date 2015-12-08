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

<div id="registerDiv">
<form action="controller.php" method="post">
	<table>
		<tr>
			<td>First name: </td>
			<td><input type="text" name="firstname" required></td>
		</tr>
		<tr>
			<td>Last name: </td>
			<td><input type="text" name="lastname" required></td>
		</tr>
		<tr>
			<td>Publication:</td>
			<td> <input type="text" name="publication" required></td>
		</tr>
		<tr>
			<td>Username: </td>
			<td><input type="text" name="username" required></td>
		</tr>
		<tr>
			<td>Password:<br><br></td>
			<td> <input type="password" name="password" pattern=".{8,}" required><p style="font-size:8px">(at least 8 characters)</p></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="register" value="Submit">
			<button type="button" onclick="window.location.href='index.php'">Cancel</button></td>
		</tr>
	</table>
</form>
</div>

<?php
	if (isset($_SESSION ['registerError'])) {
		echo $_SESSION ['registerError'];
		$_SESSION['registerError'] = "";
	}
?>