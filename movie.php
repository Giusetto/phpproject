<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Details</title>
    <style>
        .nav {
            width: 100%;
        }

        .divide {
            /width: 50%;
        }
    </style>
</head>

<body>


    <?php
require_once 'header.html'; 
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


        echo '<div class="nav justify-content-around"><div>';
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
        echo "<div class='edit-details text-right'>";
        echo "<a href='./editmovie.php?editmovie_id=" . $res['movie_id'] . "' > Edit </a><br>";
           
        if ($_SESSION) {
                echo "<select id='user_playlist'>";
                echo "<option value='' selected disabled hidden>Add to playlist</option>";
                $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
                $query = "SELECT * FROM playlist WHERE user_id='" . $_SESSION['user_id'] . "' ORDER BY date DESC";
                $results = mysqli_query($conn, $query);
                while ($db_record = mysqli_fetch_assoc($results)) {
                    echo "<option value='".$db_record['playlist_id']."'>".$db_record['name']."</option>";
                }
            }
             echo '</div></div>';
        };

    //closing the connection
    mysqli_close($connect);
    require_once 'footer.html'; 
    ?>

    
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script>
    $(function() {
            $('#user_playlist').on('change', function(e) {
                e.preventDefault();
                
console.log($(this).val());

                // similar behavior as clicking on a link
            window.location.href = "http://localhost/php/day_11/phpproject/addmovie.php?playlist_id=" + $(this).val() + "&movie_id=<?php echo $movie_id?>";
            });
        });

</script>

</body>

</html>