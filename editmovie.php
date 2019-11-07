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

        .success {
            color: green;
        }

        .wrong {
            color: red;
        }
    </style>
</head>

<body>
    <main class="container">


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

            if ($result_query) {
                echo '<h3 class="success">Edition successful';
            } else {
                echo '<h3 class="wrong">something went wrong';
            }
            //$res = mysqli_fetch_assoc($result_query);

            mysqli_close($connect);
        }





        //closing the connection

        ?>
        <br>


        <form action="#" method="POST">
            <div class="form-row">

                <div class="col">
                    <label for="title">New Title</label>
                    <input id="title" name="newtitle" type="text" class="form-control" placeholder="New Movie Title">
                </div>

                <div class="col">
                    <label for="category">New Category</label>
                    <select name="newcat" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                        <option selected></option>
                        <option value="action">Action</option>
                        <option value="sci_fi">Sci-Fi</option>
                        <option value="comedy">Comedy</option>
                    </select>
                </div>

                <div class="col">
                    <label for="date">Date</label>
                    <input name="newdate" id="date" type="date" class="form-control" placeholder="New Date of Release...">
                </div>



            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Give a description ...</label>
                <textarea name="newsynopsis" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="col">
                <input name="newposter" type="file" class="custom-file-input" id="validatedCustomFile">
                <label class="custom-file-label" for="validatedCustomFile">Upload Movie Image ...</label>
                <div class="invalid-feedback">invalid custom file feedback</div>

            </div>
            <br>

            <input type="submit" name="edit" value="Edit Movie" class="btn btn-primary btn-lg btn-block">



        </form>

        <!-- 
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
            <br>
        </form> -->



    </main>

    <?php
    require_once 'footer.html';
    ?>
</body>

</html>