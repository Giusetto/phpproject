<?php
require_once 'database.php';
$connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);




$movie = $_POST['search'];
// if (empty($_POST['search'])) {
//     echo 'fill the search bar!';
// } else {
    $query = "SELECT * FROM movies WHERE title like '%$movie%'";
    $apply_query = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_assoc($apply_query)) { ?>


        <div class="card mb-3" style="max-width: 540px;">
            <a href="movie.php?movie_id=<?php echo $row['movie_id'] ?>">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="<?php echo 'images/' . $row['poster'] ?>" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['title'] ?></h5>
                            <p class="card-text"><?php echo $row['synopsis'] ?></p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </a>
        </div>



<?php
    }

