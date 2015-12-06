Review:<br>
<textarea rows="4" cols="80" name="reviewText" form="reviewForm">Write review here</textarea>
<form action="controller.php" method="post" id="reviewForm">

    <input type="radio" name="rating" value="f" required>Fresh
    <input type="radio" name="rating" value="r" required>Rotten<br>
    <br>Name:
    <input type="text" name="reviewer" required><br>

    <input type="submit" name="newReview" value="Submit">
</form>