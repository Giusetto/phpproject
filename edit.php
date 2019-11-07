<?php
session_start();
require_once 'header.html';
if (isset($_SESSION['email'])) {
    echo "<a href='./logout.php'>Logout</a> <br>";
    echo "<a href='./create_playlist.php'>Playlist</a> <br>";
    echo "Welcome user  " . $_SESSION['First_Name'] . "<br>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <?php
    require_once 'database.php';
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
    // display the name fo the old playlist
    if (isset($_GET['id'])) {
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT name FROM playlist WHERE playlist_id='" . $_GET['id'] . "'";
        $results = mysqli_query($conn, $query);
        $db_record = mysqli_fetch_assoc($results);
        echo "The old name of the playlist was: " . $db_record['name'];
    }

    ?>



    <form action="#" method="POST">
        <input type="text" name="edit">
        <input type="submit" name='submit'>
    </form>
    <?php

    //Changing the playlist
    if (isset($_GET['id'])) {
        if (isset($_POST['submit'])) {
            $myEdit = htmlspecialchars($_POST['edit']);
            if (!empty($myEdit) && chek_playlist($myEdit)) {
                $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
                $query = "UPDATE playlist SET name='" . $myEdit . "' WHERE playlist_id='" . $_GET['id'] . "'";
                $results = mysqli_query($conn, $query);
                header("location:./create_playlist.php");
            } else {
                echo "The playlist has to have a name different form a previus one and cannot be blank";
            }
        }
    }

    require_once 'footer.html';
    ?>
</body>

</html>