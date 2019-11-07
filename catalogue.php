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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Catalogue</title>


    <style>
        .divide {
            width: 33%;
        }
    </style>
</head>

<body>


    <!-- SORTING AND FILTERING-->


    <section class="container" id="list">
        <div id="sorting-filtering" class="dropdown">
        <br>
        <select id="sortingby">
            <option value="" selected disabled hidden>Sort by:</option>
            <option value="title">Title</option>
            <option value="titled">Title descending</option>
            <option value="datea">Date ascending</option>
            <option value="dated">Date descending</option>
        </select>

        <select id="filteringby">
            <option value="" selected disabled hidden>Select a category:</option>
            <option value="action">Action</option>
            <option value="comedy">Comedy</option>
            <option value="scifi">Science Fiction</option>
        </select>

    </div>


        <?php

        require_once 'database.php';
        // OPEN A CONNECTION TO THE DATABASE
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD); //user and password are optional

        //choose the db you want to work on
        $db_found = mysqli_select_db($connect, 'moviesdb');

        if (isset($_GET['page'])) {
            $pageno = $_GET['page'];
        } else {
            $pageno = 1;
        }

        $no_of_records_per_page = 3;
        $offset = ($pageno - 1) * $no_of_records_per_page;

        $total_pages_sql = "SELECT COUNT(*) FROM movies";
        $result = mysqli_query($connect, $total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        //* sorting 

        $orderby = 'ORDER BY title ASC';
        if (isset($_GET['sort'])) {
            if ($_GET['sort'] == 'titled') {
                $orderby = 'ORDER BY title DESC';
            } else if ($_GET['sort'] == 'datea') {
                $orderby = 'ORDER BY date_of_release ASC';
            } else if ($_GET['sort'] == 'dated') {
                $orderby = 'ORDER BY date_of_release DESC';
            };
        }
        //$query = 'SELECT * FROM movies ORDER BY ' . $order;
        //var_dump($query);

        //*filtering 

        $filter = '';
        if (isset($_GET['category'])) {
            if ($_GET['category'] == 'action') {
                $filter = 'WHERE movies.category = "action"';
            } else if ($_GET['category'] == 'comedy') {
                $filter = 'WHERE movies.category = "comedy"';
            } else if ($_GET['category'] == 'scifi') {
                $filter = 'WHERE movies.category = "sci_fi"';
            };
        }

        $user = $_SESSION['user_id'];

        $query = "SELECT * FROM movies
        $filter
        $orderby 
        LIMIT $offset, $no_of_records_per_page";

        /* 
        JOIN movie_playlist ON movies.movie_id = movie_playlist.movie_id
        JOIN playlist ON movie_playlist.playlist_id = playlist.playlist_id
        JOIN users ON users.user_id = playlist.user_id
        WHERE playlist.user_id = $user 
        */

        //!
    /*
    <?php
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
    $query = "SELECT * FROM playlist WHERE user_id='" . $_SESSION['user_id'] . "' ORDER BY date DESC";

    $results = mysqli_query($conn, $query);
    
    while ($db_record = mysqli_fetch_assoc($results)) {
       
    }
    mysqli_close($conn);
    ($conn);
     ?>   
*/
        //!
        //sends an sql request to our db
        $result_query = mysqli_query($connect, $query);
        echo "<div class='container'>";
        while ($res = mysqli_fetch_assoc($result_query)) {
            echo '<hr>';

            echo '<div class="nav justify-content-between"><div class="divide">';
            echo "<img src='./images/" . $res['poster'] . "' width='200'>" . '</div><br>';
            echo '<div class="movie-info divide">';
            echo "#" . $res['movie_id'] . " ";
            echo "<h2>" .  $res['title'] . "</h2>";
            echo $res['date_of_release'] . '<br>';
            echo "<br><p>" . substr($res['synopsis'], 0, 100) . '...</p><br>';
            echo "</div>";
            echo "<div class='edit-details text-right divide'>";
            /*if ($_SESSION) {
                echo "<select id='user_playlist'>";
                echo "<option value='' selected disabled hidden>Add to playlist</option>";
                $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
                $query = "SELECT * FROM playlist WHERE user_id='" . $_SESSION['user_id'] . "' ORDER BY date DESC";
                $results = mysqli_query($conn, $query);
                while ($db_record = mysqli_fetch_assoc($results)) {
                    echo "<option value='".$db_record['name']."'>".$db_record['name']."</option>";
                }
                mysqli_close($conn);
                echo  "</select><br>";
            };*/
            echo "<a href='./movie.php?movie_id=" . $res['movie_id'] . "' > More details </a><br>";
            echo "<a href='./editmovie.php?editmovie_id=" . $res['movie_id'] . "' > Edit </a><br>";
            echo '</div></div>';
        }
        echo "</div>";


        //closing the connection
        mysqli_close($connect);

        ?>
    </section>

    <footer>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="?page=1">First</a></li>
                <li class="<?php if ($pageno <= 1) {
                                echo 'disabled';
                            } ?> page-item">
                    <a href="<?php if ($pageno <= 1) {
                                    echo '#';
                                } else {
                                    echo "?page=" . ($pageno - 1);

                                    if (isset($_GET['sort']))
                                        echo "&sort=" . $_GET['sort'];
                                    //filter category
                                    if (isset($_GET['category']))
                                        echo "&sort=" . $_GET['category'];
                                } ?>" class="page-link">Prev</a>
                </li>
                <li class="<?php if ($pageno >= $total_pages) {
                                echo 'disabled';
                            } ?> page-item">
                    <a href="<?php if ($pageno >= $total_pages) {
                                    echo '#';
                                } else {
                                    echo "?page=" . ($pageno + 1);

                                    if (isset($_GET['sort']))
                                        echo "&sort=" . $_GET['sort'];
                                    //filter category
                                    if (isset($_GET['category']))
                                        echo "&sort=" . $_GET['category'];
                                } ?>" class="page-link"> Next </a>
                </li>
                <li class="page-item">
                    <a href="?page=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
            </ul>
        </nav>
    </footer>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

    <script>
        $(function() {
            $('#sortingby').on('change', function(e) {
                e.preventDefault();
                // similar behavior as clicking on a link
                window.location.href = "http://localhost/php/day_11/phpproject/catalogue.php?sort=" + $(this).val();
            });
        });

        $(function() {
            $('#filteringby').on('change', function(e) {
                e.preventDefault();
                // similar behavior as clicking on a link
                window.location.href = "http://localhost/php/day_11/phpproject/catalogue.php?category=" + $(this).val();
            });
        });

   

    </script>
    <?php
    
    require_once 'footer.html'; 
    ?>
</body>

</html>