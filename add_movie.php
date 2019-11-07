<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Add Movie</title>

    <style>
    .success{
        color: green;
    }
    .wrong{
        color: red;
    }
    </style>
</head>



<body>
    <?php require_once"database.php";
    $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
    ?>
    <main class="container">
        <?php require_once "header.html" ?>
        <br>
        <hr>
        <?php
        if (isset($_POST['submit'])) {

            if ($_POST['title'] == '')
                echo '<h3 class="wrong">Please fill the title feild</h3>' . '<br>';


            if ($_POST['category'] == '')
                echo '<h3 class="wrong">Please choose the category</h3>' . '<br>';


            $query = "INSERT INTO movies (title, category, date_of_release, synopsis, poster) 
            VALUES ('" . $_POST['title'] . "', '" . $_POST['category'] . "', '" . $_POST['date_of_release'] . "', '" . $_POST['synopsis'] . "','" . $_POST['poster'] . "')";

            $result = mysqli_query($connect, $query);

            if(!empty($_POST['title']) AND !empty($_POST['category'])){
                echo '<h3 class="success"> Movie add successfully!</h3>';
            }



            // var_dump($_POST);
        }
        ?>
        <form action="#" method="POST" >
            <div class="form-row">

                <div class="col">
                    <label for="title">Title</label>
                    <input id="title" name="title" type="text" class="form-control" placeholder="Movie Title">
                </div>

                <div class="col">
                    <label for="category">Category</label>
                    <select name="category" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                        <option selected></option>
                        <option value="action">Action</option>
                        <option value="sci_fi">Sci-Fi</option>
                        <option value="comedy">Comedy</option>
                    </select>
                </div>

                <div class="col">
                    <label for="date">Date</label>
                    <input name="date_of_release" id="date" type="date" class="form-control" placeholder="Date of Release...">
                </div>



            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Give a description ...</label>
                <textarea name="synopsis" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="col">
                <input name="poster" type="file" class="custom-file-input" id="validatedCustomFile">
                <label class="custom-file-label" for="validatedCustomFile">Upload Movie Image ...</label>
                <div class="invalid-feedback">invalid custom file feedback</div>

            </div>
            <br>

            <input type="submit" name="submit" value="Add Movie" class="btn btn-primary btn-lg btn-block">



        </form>

        <hr>
        <?php require_once "footer.html" ?>
    </main>
</body>

</html>