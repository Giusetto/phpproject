

<?php
    require_once 'database.php';
    if($_GET['id']){
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query= "DELETE FROM playlist WHERE playlist_id='".$_GET['id']."'";
        $results = mysqli_query($conn, $query);
        mysqli_close($conn);
        header("location:./create_playlist.php");



    }


?>