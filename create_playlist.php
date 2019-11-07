<?php
session_start();
    if(isset($_SESSION['email'])){
        echo "<a href='./logout.php'>Logout</a> <br>";
        echo "Welcome user  ".$_SESSION['First_Name']."<br>";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<?php
    
    require_once 'database.php';
    if(isset($_POST['submit'])){
                $myPlayName= htmlspecialchars($_POST['playName']);
                
                if($myPlayName){
                    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                    $query="INSERT INTO playlist (name, date, user_id) VALUES ('".$_POST['playName']."', '".date("Y-m-d")."', '".$_SESSION['user_id']."')";
                    echo $query; 
                    $results = mysqli_query($conn, $query);
                    echo "Record inserted"."<br>"; 
                        
                }else 
                        echo "Playlist should have a name"."<br>";
              }


?>



</head> 
<body>
    

<H1>Add playlist</H1>
<form action="#" method="POST">
    <ul>
        <li><input type="text"  placeholder="Name of playlist"  name="playName"></li> <br>
        <li><input type="submit" name="submit" value="Add"></li> <br>
        
    </ul>


<body>



    
</body>
</html>