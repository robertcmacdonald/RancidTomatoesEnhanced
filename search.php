<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="movie.css">
    <meta charset="UTF-8">
    <title></title>
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
            <li class='navbarItem'><a href="newReview.php">Add new review</a></li>
            <li class='navbarItem'><a href="newMovie.php">Add new movie</a></li>
            <li class='navbarItem'><a href="logout.php">Logout</a></li>
        <?php
            } else {
        ?>
            <li class='navbarItem'><a href="login.php">Login or register</a></li>
        <?php
            }
        ?>
    </ul>
<div id="inputBox">
    Movie Title:  <input type="text" id="movieTitle" oninput="searchAndDisplay()">
</div>
<div id="firstBox">
    <p id="firstTitles">

    </p>
</div>
<div id="secondBox">
    <p id ="secondTitles">

    </p>
</div>
</body>
<script>
    function searchAndDisplay(){
        var input = document.getElementById("movieTitle").value;

        var xhttp =  new XMLHttpRequest();

        xhttp.onreadystatechange = function(){
            var testing = document.getElementById("inputBox");
            if (input == "" ) {
                var firstbox = document.getElementById("firstTitles");
                firstbox.innerHTML = "";
                var secondBox = document.getElementById("secondTitles");
                secondBox.innerHTML = "";
            } else {
               if(xhttp.readyState = 4 && xhttp.status == 200){
                var array = JSON.parse(xhttp.responseText);
                var firstbox = document.getElementById("firstTitles");
                firstbox.innerHTML = "";
                for(var i =0; i < array.length && i < 10; i++){
                    firstbox.innerHTML += '<a href="reviewPage.php?movieTitle=' + array[i].movieTitle + '">' + 
                        array[i].movieTitle + '</a><br>';
                }
                var secondBox = document.getElementById("secondTitles");
                secondBox.innerHTML = "";
                if(array.length > 10){
                    for( var ii = 10; ii < 20 && ii < array.length; ii++){
                        secondBox.innerHTML += array[ii].movieTitle + '<br>';
                    }
                }
            } 
            }

            
        };

        /*xhttp.open("POST", "controller.php",true);
        xhttp.send('search=' + input);*/
        xhttp.open("GET", "controller.php?search=" + input, true);
        xhttp.send();
        // now display the array in the appropriate boxes
    }
</script>
</html>
