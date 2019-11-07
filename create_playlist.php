<?php
session_start();
require_once 'header.html'; 

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create playlist</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        ul {
            list-style-type: none;
        }

        a {
            text-decoration: none;
        }
        main{
            text-align: left;
        }
    </style>


</head>

<?php

require_once 'database.php';


//verifi if there was an old playlist
function chek_playlist($PlayName)
{
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
    $query = "SELECT * FROM playlist WHERE user_id='" . $_SESSION['user_id'] . "' AND name='" . $PlayName . "'";
    $results = mysqli_query($conn, $query);
    if (($results->num_rows) > 0) {
        return false;
    }
    return TRUE;
}

//add playlist
if (isset($_POST['submit'])) {
    $myPlayName = htmlspecialchars($_POST['playName']);

    if ($myPlayName && chek_playlist($myPlayName)) {
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "INSERT INTO playlist (name, date, user_id) VALUES ('" . $_POST['playName'] . "', '" . date("Y-m-d") . "', '" . $_SESSION['user_id'] . "')";
        //echo $query; 
        $results = mysqli_query($conn, $query);
    } else
        echo "Playlist should have a name and different fron previuos name" . "<br>";
}
//display playlist
?>

</head>
<body>


<main class="container">
    
        <?php    
            require_once 'header.html'; 
            if (isset($_SESSION['email'])) {
                echo "<a href='./logout.php'>Logout</a> <br>";
                echo "Welcome user  " . $_SESSION['First_Name'] . "<br>";
            }
        ?>

    
        
        
        <H1>Add playlist</H1>
        <form action="#" method="POST">
        <ul>
            <li><input type="text" placeholder="Name of playlist" name="playName"></li> <br>
            <li><input type="submit" name="submit" value="Add"></li> <br>
            
        </ul>
        
        <?php
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT * FROM playlist WHERE user_id='" . $_SESSION['user_id'] . "' ORDER BY date DESC";
        
        
        $results = mysqli_query($conn, $query);
        while ($db_record = mysqli_fetch_assoc($results)) {
            echo "<p> <strong>Playlist name</strong> :" . $db_record['name'] . " <strong>Creation date</strong>: " . $db_record['date'] . "<a href='edit.php?id=" . $db_record['playlist_id'] . "'> Edit</a> <a href='delete.php?id=" . $db_record['playlist_id'] . "'> Delete</a> </p> ";
            $movie_query="SELECT title FROM movies JOIN movie_playlist ON movies.movie_id=movie_playlist.movie_id WHERE movie_playlist.playlist_id=".$db_record['playlist_id'];
            $movie_results = mysqli_query($conn, $movie_query);
            while($db_record_movie=mysqli_fetch_assoc($movie_results)){
                echo "<p><strong>Movie name</strong> :".$db_record_movie['title'];    
            }

        }
        mysqli_close($conn);
        require_once 'footer.html';
        
        
        ?>

</main>

</body>

</html>