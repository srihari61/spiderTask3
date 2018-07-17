<?php
    session_start();
    if($_SESSION['user']){
    }
    else{ 
       header("location:index.php");
    }
    GLOBAL $username=mysqli_real_escape_string($_POST['username']);

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $titleFav = mysqli_real_escape_string($_POST['titleFav']);
       $authorLib = mysqli_real_escape_string($_POST['authorFav']);
       $ISBNLib = mysqli_real_escape_string($_POST['ISBNFav']);
   
       mysqli_connect("localhost","root","") or die(mysqli_error()); //Connect to server
       mysqli_select_db("spidertask3") or die("Cannot connect to database"); //Conect to database
       mysqli_query("INSERT INTO '.$username. FavBook' (title,author,ISBN) VALUES ('$titleFav','$authorFav','$ISBNFav')"); //SQL query
       header("location:home.php");
    }
    else
    {
       header("location:home.php");
    }
?>