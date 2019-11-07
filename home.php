<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .card {
            width: 25%;
        }

        #inlineFormInput {
            width: 900px;

        }

        .card {
            width: 100%;

        }

        a{
            text-decoration: none;
        }
    </style>
    <title>Home</title>
</head>

<body>

    <?php
    require_once 'database.php';
    $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
    ?>

    <main class="container">

        <?php require_once 'header.html' ?>
        <p>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>


        <form class="d-flex bd-highlight" action="#" method="POST">
            <input type="text" class="form-control my-0 py-1 lime-border" name="search" id="search_bar">
            <input type="submit" class="input-group-append" name="submit" value="Search" id="clickbutton">
        </form>
        <br>
        <hr>

        <div id="myform"></div>
        <br>



        <?php $query = "SELECT category, count(*) FROM movies GROUP BY category "; ?>

        <?php $result = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['category'] == 'sci_fi') {
                $scieNum = $row['count(*)'];
            }
            if ($row['category'] == 'action') {
                $actionNum = $row['count(*)'];
            }
            if ($row['category'] == 'comedy') {
                $comedyNum = $row['count(*)'];
            }
        }
        ?>
        <div>
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" href="catalogue.php?category=sci_fi">science fiction(<?php echo $scieNum ?>)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="catalogue.php?category=action">action(<?php echo $actionNum ?>)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="catalogue.php?category=comedy">comedy(<?php echo $comedyNum ?>)</a>
                </li>

            </ul>

        </div>
        <br>
        <?php
        $card_query = "SELECT * FROM movies ORDER BY date_of_release ASC LIMIT 4";
        $card_result = mysqli_query($connect, $card_query);
        $arr = [];
        while ($card_row = mysqli_fetch_assoc($card_result)) {
            $arr[] = $card_row;
        }
        // var_dump($arr);

        ?>
        <div class="card-deck">

            <div class="card">
                <a href="movie.php?movie_id=<?php echo $arr[0]['movie_id'] ?>">
                    <img src="<?php echo 'images/' . $arr[0]['poster'] ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $arr[0]['title'] ?></h5>
                        <p class="card-text"><?php echo $arr[0]['synopsis'] ?></p>
                        <p class="card-text"><small class="text-muted"><?php echo $arr[0]['date_of_release'] ?></small></p>
                    </div>
                </a>
            </div>
            <div class="card">
                <a href="movie.php?movie_id=<?php echo $arr[1]['movie_id'] ?>">
                    <img src="<?php echo 'images/' . $arr[1]['poster'] ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $arr[1]['title'] ?></h5>
                        <p class="card-text"><?php echo $arr[1]['synopsis'] ?></p>
                        <p class="card-text"><small class="text-muted"><?php echo $arr[1]['date_of_release'] ?></small></p>
                    </div>
                </a>
            </div>
            <div class="card">
                <a href="movie.php?movie_id=<?php echo $arr[2]['movie_id'] ?>">
                    <img src="<?php echo 'images/' . $arr[2]['poster'] ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $arr[2]['title'] ?></h5>
                        <p class="card-text"><?php echo $arr[2]['synopsis'] ?></p>
                        <p class="card-text"><small class="text-muted"><?php echo $arr[2]['date_of_release'] ?></small></p>
                    </div>
                </a>
            </div>

            <div class="card">
                <a href="movie.php?movie_id=<?php echo $arr[3]['movie_id'] ?>">
                    <img src="<?php echo 'images/' . $arr[3]['poster'] ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $arr[3]['title'] ?></h5>
                        <p class="card-text"><?php echo $arr[3]['synopsis'] ?></p>
                        <p class="card-text"><small class="text-muted"><?php echo $arr[3]['date_of_release'] ?></small></p>
                    </div>
                </a>
            </div>
        </div>
        <?php require_once 'footer.html' ?>
    </main>

    <script src=" https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
    </script>

    <script>
        $(function() {
            $('#search_bar').keyup(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'search.php',
                    type: 'post',
                    data: $('form').serialize(),
                    success: function(result) {
                        $('#myform').html(result);

                    },
                    error: function(err) {
                        $('#myform').html(err);
                    }
                });
            });
        });
    </script>
    <script>
        $(function() {
            $('#clickbutton').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'search.php',
                    type: 'post',
                    data: $('form').serialize(),
                    success: function(result) {
                        $('#myform').html(result);

                    },
                    error: function(err) {
                        $('#myform').html(err);
                    }
                });
            });
        });
    </script>

</html>