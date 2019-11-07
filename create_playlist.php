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
    <style>
        ul {
                list-style-type: none;
        }
        a{
            text-decoration:none;
        }
    </style>


</head>

<?php
    


        //verifi if there was an old playlist
    function chek_playlist($PlayName){
         $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
         $query="SELECT * FROM playlist WHERE user_id='".$_SESSION['user_id']."' AND name='".$PlayName."'";
         $results = mysqli_query($conn, $query);
        if(($results->num_rows) >0){
             return false;
        }
        return TRUE;
                    
    }

   require_once 'database.php';
    //add playlist
    if(isset($_POST['submit'])){
                $myPlayName= htmlspecialchars($_POST['playName']);
                
                if($myPlayName && chek_playlist($myPlayName)){
                    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                    $query="INSERT INTO playlist (name, date, user_id) VALUES ('".$_POST['playName']."', '".date("Y-m-d")."', '".$_SESSION['user_id']."')";
                    //echo $query; 
                    $results = mysqli_query($conn, $query);
                   
                }else 
                        echo "Playlist should have a name and different fron previuos name"."<br>";
    }
    //display playlist
?>

</head>

<body>
    

<H1>Add playlist</H1>
<form action="#" method="POST">
    <ul>
        <li><input type="text"  placeholder="Name of playlist"  name="playName"></li> <br>
        <li><input type="submit" name="submit" value="Add"></li> <br>
        
    </ul>

<?php
   $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
   $query="SELECT * FROM playlist WHERE user_id='".$_SESSION['user_id']."' ORDER BY date DESC";
   
   
   $results = mysqli_query($conn, $query);
   while ($db_record = mysqli_fetch_assoc($results)) {
       echo "<div><p> ".$db_record['name']." ".$db_record['date']."<a href='edit.php?id=".$db_record['playlist_id']."'> Edit</a> <a href='delete.php?id=".$db_record['playlist_id']."'> Delete</a> </p> ";
   }
   mysqli_close($conn);($conn);
       
       
      
       
   
?>

    
</body>
</html>