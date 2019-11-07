<?php
    session_start();
    
    if(isset($_SESSION['email'])){
      echo "user already logged in"."<br>";  
      header("location:./myaccount.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Login</title>
    <style>
        ul {
                list-style-type: none;
        }
    
    </style>
    <?php
    //require_once 'nav.html';
    require_once 'database.php';
    
    $email='';
    $password='';


    
    function data_chek($mail,$pass){
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT * FROM users";
        $results = mysqli_query($conn, $query);
        while ($db_record = mysqli_fetch_assoc($results)) {
            if($mail===$db_record['email'] && password_verify ($pass,$db_record['password'])){
               
                $_SESSION['email']=$db_record['email'];
                $_SESSION['First_Name']=$db_record['First_Name'];
                $_SESSION['user_id']=$db_record['user_id'];
                return TRUE;
            }
        }
        return FALSE;
        mysqli_close($conn);
    }

    
    if(isset($_POST['submit'])){
        $email= htmlspecialchars($_POST['email']);
        $password= htmlspecialchars($_POST['password']);
            $email=filter_var($email,FILTER_SANITIZE_EMAIL);
            $email=filter_var($email,FILTER_VALIDATE_EMAIL);
            if($email && isset($password)){
                if(data_chek($email,$password)){
                    echo "User logged in"."<br>";
                    header("location:./myaccount.php");
                
                }
                else
                    echo "User not found. Invalid Match"."<br>";
            }else 
                    echo " data not ok"."<br>";

        }
    ?>

</head> 
<body>
<main class=container>
    <H1>Login</H1>
    <form action="#" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
        </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>


<a href="#">Forgot yout password?</a>

</main>



</body>
</html>
