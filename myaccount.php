<?php
session_start();
    if(isset($_SESSION['email'])){
        echo "<a href='./logout.php'>Logout</a> <br>";
        echo "<a href='./create_playlist.php'>New Playlist</a> <br>";
        echo "Welcome user  ".$_SESSION['First_Name']."<br>";
        echo "with user id".$_SESSION['user_id'];
    }
?>