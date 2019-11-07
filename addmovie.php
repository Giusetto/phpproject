<?php

require_once 'database.php';
//addmovie to playlist 
$user = $_SESSION['user_id'];

if (isset($_GET)) {
    $playlist = $_GET['playlist_id'];
    $movie = $_GET['movie_id'];

    // OPEN A CONNECTION TO THE DATABASE
    $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD); //user and password are optional
    //choose the db you want to work on
    $db_found = mysqli_select_db($connect, 'moviesdb');

    $query = "INSERT INTO movie_playlist (movie_id, playlist_id) VALUES ('$movie', '$playlist')";

    $result_query = mysqli_query($connect, $query);
    header("location:./movie.php?movie_id=" . $movie);
}
