<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Registration</title>
    <style>
        ul {
                list-style-type: none;
        }
            
    
    </style>
    <?php
    require_once 'nav.html';
    require_once 'database.php';
    
    $FirstName='';
    $LastName='';
    $email='';
    $password='';

        function data_chek($mail){
            $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "SELECT * FROM users";
            $results = mysqli_query($conn, $query);
            while ($db_record = mysqli_fetch_assoc($results)) {
                 if($mail===$db_record['email'])
                        return FALSE;
            }
            return TRUE;
            mysqli_close($conn);
        }

        if(isset($_POST['submit'])){
            $FirstName= htmlspecialchars($_POST['First_Name']);
            $LastName= htmlspecialchars($_POST['Last_Name']);
            $email= htmlspecialchars($_POST['email']);
            $password= htmlspecialchars($_POST['password']);
            $email=filter_var($email,FILTER_SANITIZE_EMAIL);
            $email=filter_var($email,FILTER_VALIDATE_EMAIL);
            if($email && !empty($FirstName) && !empty($LastName) && !empty($password) && $password>7){
               if(data_chek($email)){   
                    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                   $query="INSERT INTO users (Last_Name, email, First_Name, password) VALUES ('".$LastName."','".$email."', '".$FirstName."','".password_hash($password,PASSWORD_DEFAULT)."')";
                   $results = mysqli_query($conn, $query);
                    //echo $query;
                }
               else
                echo "already existing email"."<br>";
            }else 
                    echo " data not ok some"."<br>";




        }


    ?>



</head> 
<body>
    

<H1>Registration</H1>
<form action="#" method="POST">
    <ul>
        <li><input type="text"  placeholder="First Name"  name="First_Name"  value='<?php echo $FirstName ?>' ></li> <br>
        <li><input type="text"  placeholder="Last Name"  name="Last_Name"  value='<?php echo $LastName ?>' ></li> <br>
        <li><input type="mail" placeholder="email" name="email" value='<?php echo $email ?>'></li> <br>
        <li><input type="password"   placeholder="password"  name="password"></li> <br>
        <li><input type="submit" name="submit"></li> <br>
        
    </ul>

    




</body>
</html>
