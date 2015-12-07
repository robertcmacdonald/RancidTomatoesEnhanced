<html>
<head>
    <title>Rancid Tomatoes</title>
    <link rel="stylesheet" href="movie.css">
    <meta charset="utf-8" />
</head>
<body>
    <ul id='navbarUL'>
        <li class='navbarItem'><a href="search.php">Search for a movie</a></li>
        <li class='navbarItem'><a href="index.php">Home</a></li>
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

<form action="controller.php" method="post" enctype="multipart/form-data" id="movieForm">
    Title:<input type="text" name="title" required><br>
    Year: <input type="number" name="year" required><br>
    Director: <input type="text" name="director" required><br>
    Rating:
    <input type="radio" name="rating" value="0">G
    <input type="radio" name="rating" value="1">PG
    <input type="radio" name="rating" value="2">PG-13
    <input type="radio" name="rating" value="3">R
    <br>
    Runtime (IN MINUTES): <input type="number" name="runtime" required><br>
    BoxOffice (IN MILLIONS): <input  type="number" name="boxOffice" required><br>
    Image: <input type="file" name="movieImage" accept="image/*" required>
    <input type="submit" name="addMovie" value="Submit">
</form>
<!-- TODO: add cancel button to clear everything and take user to homepage -->
