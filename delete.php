

<?php
    require_once 'database.php';
    require_once 'header.html'; 
    if($_GET['id']){
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
        $query= "DELETE FROM playlist WHERE playlist_id='".$_GET['id']."'";
        $results = mysqli_query($conn, $query);
        mysqli_close($conn);
        header("location:./create_playlist.php");



    }

require_once 'footer.html';
?>