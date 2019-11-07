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
    if (isset($_POST['edit'])) {
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD); //user and password are optional

        //choose the db you want to work on
        $db_found = mysqli_select_db($connect, 'moviesdb');

        $movie_id = $_GET['editmovie_id'];


        $newtitle = $_POST['newtitle'];
        $newcategory = $_POST['newcat'];
        $newposter = $_POST['newposter'];
        $newdate = $_POST['newdate'];
        $newsynopsis = $_POST['newsynopsis'];

        $sql = "UPDATE movies SET title = '$newtitle', category = '$newcategory', poster = '$newposter', date_of_release = '$newdate', synopsis = '$newsynopsis' 
        WHERE movies.movie_id = $movie_id";

        $result_query = mysqli_query($connect, $sql);

        if($result_query){
            echo "Edition successful";
        } else {
            echo "something went wrong";
        }
        //$res = mysqli_fetch_assoc($result_query);

        mysqli_close($connect);
    }





    //closing the connection
    require_once 'footer.html';
    ?>
    <form action="#" method="post">
        <input type="text" name="newtitle" placeholder="new title">
        <br>
        <input type="text" name="newcat" placeholder="new category">
        <br>
        <input type="text" name="newposter" placeholder="new poster">
        <br>
        <input type="date" name="newdate">
        <br>
        <input type="text" name="newsynopsis" placeholder="new synopsis">
        <br>

        <input type="submit" name="edit" value="send">

    </form>
</body>

</html>