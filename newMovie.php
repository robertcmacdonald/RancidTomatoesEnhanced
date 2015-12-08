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



<div id="newMovieDiv">
<form action="controller.php" method="post" enctype="multipart/form-data" id="movieForm">
    <table id="newMovieTable">
        <tr>
            <td>Title:</td>
            <td><input type="text" name="title" required></td>
        </tr>
        <tr>
            <td>Year:</td> 
            <td><input type="number" name="year" required></td>
        </tr>
        <tr>
            <td>Director: </td>
            <td><input type="text" name="director" required></td>
        </tr>
        <tr>
            <td>Rating:</td>
            <td><input type="radio" name="rating" value="0">G
            <input type="radio" name="rating" value="1">PG
            <input type="radio" name="rating" value="2">PG-13
            <input type="radio" name="rating" value="3">R</td>
        </tr>
        <tr>
            <td>Runtime (IN MINUTES): </td>
            <td><input type="number" name="runtime" required></td>
        </tr>
        <tr>
            <td>Box Office (IN MILLIONS): </td>
            <td><input  type="number" name="boxOffice" required></td>
        </tr>
        <tr>
            <td>Image: </td>
            <td><input type="file" name="movieImage" accept="image/*" required></td>
        <tr>
            <td></td>
            <td><input type="submit" name="addMovie" value="Submit">
                <button type="button" onclick="window.location.href='index.php'">Cancel</button></td>
        </tr>
    </table>
</form>
</div>

<?php
    if (isset($_SESSION['movieError'])) {
        echo $_SESSION['movieError'];
        $_SESSION['movieError'] = "";
    }
?>
