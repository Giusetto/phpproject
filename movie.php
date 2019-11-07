<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Details</title>
    <style>
    
    </style>
</head>

<body>


    <?php

    require_once 'database.php';

    // OPEN A CONNECTION TO THE DATABASE
    $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD); //user and password are optional

    //choose the db you want to work on
    $db_found = mysqli_select_db($connect, 'moviesdb');

    $movie_id = $_GET['movie_id'];


    if ($db_found) {
        echo "<div class='top'>";
        echo 'Movie info' . '<br>';
        echo "<a href='http://localhost/php/day_11/phpproject/catalogue.php'>Back to Movie Catalog</a>" . "<br>";
        echo "</div>";
        echo '<hr>';

        $query = "SELECT * FROM movies 
        JOIN actors_movies ON movies.movie_id = actors_movies.movie_id 
        JOIN actors ON actors.actor_id = actors_movies.actor_id
        WHERE movies.movie_id = " . $movie_id;

        //sends an sql request to our db
        $result_query = mysqli_query($connect, $query);

        $res = mysqli_fetch_assoc($result_query);


        echo '<div class="nav justify-content-around"><div class="divide">';
        echo "<img src='./images/" . $res['poster'] . "' width='400'>" . '</div><br>';
        echo '<div class="movie-info divide">';
        echo "<h2>" .  $res['title'] . "</h2>";
        echo $res['date_of_release'] . '<br>';
        echo "<br><p>" . $res['synopsis'] . '</p><br>';
        echo "Category: " . $res['category'] . "<br>";
        //*ACTORS

        echo "<br>Actors:<br>";
        do {
            echo $res['name'] . "<br>";
        } while ($res = mysqli_fetch_assoc($result_query));


        echo "</div>";
        echo "<div class='edit-details text-right divide'>";
        echo "<a href='/edit.php'> Edit </a>" . "<br>";
        echo '</div></div>';
    } else {
        echo 'moviesdb not found!';
    }

    //closing the connection
    mysqli_close($connect);
    ?>


</body>

</html>