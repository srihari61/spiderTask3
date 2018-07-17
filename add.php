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
       $titleLib = mysqli_real_escape_string($_POST['titleLib']);
       $authorLib = mysqli_real_escape_string($_POST['authorLib']);
       $ISBNLib = mysqli_real_escape_string($_POST['ISBNLib']);
   
       mysqli_connect("localhost","root","") or die(mysqli_error()); //Connect to server
       mysqli_select_db("spidertask3") or die("Cannot connect to database"); //Conect to database
       mysqli_query("INSERT INTO '.$username. ReadBook' (title,author,ISBN) VALUES ('$titleLib','$authorLib','$ISBNLib')"); //SQL query
       header("location:home.php");
    }
    else
    {
       header("location:home.php");
    }
?>