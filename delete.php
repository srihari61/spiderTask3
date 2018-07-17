<?php
    session_start(); //starts the session
    if($_SESSION['user']){ //checks if user is logged in
    }
    else {
       header("location:index.php"); //redirects if user is not logged in.
    }
$username=mysqli_real_escape_string($_POST['username']);
$query=mysqli_query("DELETE FROM '.$username. ReadBook' WHERE id='$id'
                     DELETE FROM '.$username. FavBook' WHERE id='$id'");
    if($_SERVER['REQUEST_METHOD'] == "GET")
    {
       mysqli_connect("localhost", "root", "") or die(mysqli_error()); //connect to server
       mysqli_select_db("deltatask2") or die("cannot connect to database"); //Connect to database
       $id = $_GET['id'];
       while($row = mysqli_fetch_array($query))
       {
       }
       header("location:home.php");
    }
?>