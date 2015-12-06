<form action="controller.php" method="post" id="movieForm">
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
    Image: <!-- TODO: figure out image upload shit for database? -->
    <input type="submit" name="addMovie" value="Submit">
</form>
<!-- TODO: add cancel button to clear everything and take user to homepage -->
