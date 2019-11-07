<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['email'])) {
        echo "<a href='./logout.php'>Logout</a> <br>";
        echo "<a href='./create_playlist.php'>New Playlist</a> <br>";
        echo "Welcome user  " . $_SESSION['First_Name'] . "<br>";
        echo "with user id" . $_SESSION['user_id'];
    }
    ?>

</body>

</html>