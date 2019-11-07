<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Registration</title>

    <style>
        ul {
            list-style-type: none;
        }
    </style>
    <?php
    require_once 'header.html';
    require_once 'nav.html';
    require_once 'database.php';

    $FirstName = '';
    $LastName = '';
    $email = '';
    $password = '';

    function data_chek($mail)
    {
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT * FROM users";
        $results = mysqli_query($conn, $query);
        while ($db_record = mysqli_fetch_assoc($results)) {
            if ($mail === $db_record['email'])
                return FALSE;
        }
        return TRUE;
        mysqli_close($conn);
    }

    if (isset($_POST['submit'])) {
        $FirstName = htmlspecialchars($_POST['First_Name']);
        $LastName = htmlspecialchars($_POST['Last_Name']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($email && !empty($FirstName) && !empty($LastName) && !empty($password) && strlen($password)>7) {
            if (data_chek($email)) {
                $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
                $query = "INSERT INTO users (Last_Name, email, First_Name, password) VALUES ('" . $LastName . "','" . $email . "', '" . $FirstName . "','" . password_hash($password, PASSWORD_DEFAULT) . "')";
                $results = mysqli_query($conn, $query);
                echo "User added"."<br>";
            } else
                echo "already existing email" . "<br>";
        } else
            echo " data not ok some" . "<br>";
    }


    ?>



</head>

<body>
    <main class="container">

        <form action="#" method="POST">
            <H1>Registration</H1>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter first name" name="First_Name">
                
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter last name" name="Last_Name">
            </div>    
            
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </main>
        



        <?php
        require_once 'footer.html';
        ?>
</body>

</html>