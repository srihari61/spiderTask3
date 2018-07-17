<html>
	<head>
		<title>My first PHP website</title>
	</head>
	<?php
	session_start(); //starts the session
	if($_SESSION['user']){ //checks if user is logged in
	}
	else{
		header("location:index.php"); // redirects if user is not logged in
	}
	$user = $_SESSION['user']; //assigns user value
	$id_exists = false;
	?>
	<body>
		<h2>Home Page</h2>
		<p>Hello <?php Print "$user"?>!</p> <!--Displays user's name-->
		<a href="logout.php">Click here to logout</a><br/><br/>
		<a href="home.php">Return to Home page</a>
		<h2 align="center">Currently Selected</h2>
		<table border="1px" width="100%">
			<tr>
				<th>Date</th>
				<th>Title</th>
				<th>Description</th>
				<th>Start Time</th>
				<th>End Time</th>
				<th>Delete</th>
			</tr>
			<?php
				GLOBAL $username=mysqli_real_escape_string($_POST['username']);
				if(!empty($_GET['dispDate']))
				{
					$id = $_GET['dispDate'];
					$_SESSION['dispDate'] = $id;
					$dispDate_exists = true;
					mysqli_connect("localhost", "root","") or die(mysqli_error()); //Connect to server
					mysqli_select_db("deltatask2") or die("Cannot connect to database"); //connect to database
					$query = mysqli_query("Select * from '.$username.' Where dispDate='$id'"); // SQL Query
					$count = mysql_num_rows($query);
					if($count > 0)
					{
						while($row = mysql_fetch_array($query))
						{
							Print "<tr>";
							    Print '<td align="center">'. $row['dispDate'] . "</td>";
						        Print '<td align="center">'. $row['title'] . "</td>";
						        Print '<td align="center">'. $row['description']."</td>";
						        Print '<td align="center">'. $row['startTime']."</td>";
						        Print '<td align="center">'. $row['endTime']."</td>";
						    Print "</tr>";    
						}
					}
					else
					{
						$id_exists = false;
					}
				}
			?>
		</table>
		<br/>
		<?php
		if($dispDate_exists)
		{
		Print '
		<form action="edit.php" method="POST">
			Enter new detail: 
			Date:<input type="text" name="dateApp"/><br/>
			Title:<input type="text" name="titleApp"/><br/>
			Data:<input type="text" name="data"/><br/>
		    Start Time:<input type="text" name="startTimeApp"/><br/>
			End Time:<input type="text" name="endTimeApp"/><br/>

			<input type="submit" value="Update List"/>
		</form>
		';
		}
		else
		{
			Print '<h2 align="center">There is no data to be edited.</h2>';
		}
		?>
	</body>
</html>

<?php
GLOBAL $username=mysqli_real_escape_string($_POST['username']);
   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
      mysqli_connect("localhost", "root", "") or die (mysqli_error()); //Connect to server
      mysqli_select_db("deltatask2") or die ("Cannot connect to database"); //Connect to database
     $dateApp = mysqli_real_escape_string($_POST['dateApp']);
       $titleApp = mysqli_real_escape_string($_POST['titleApp']);
       $data = mysqli_real_escape_string($_POST['data']);
       $startTimeApp = mysqli_real_escape_string($_POST['startTimeApp']);
       $endtimeApp = mysqli_real_escape_string($_POST['endTimeApp']);
     /* foreach($_POST['public'] as $list)
      {
         if($list != null)
         {
            $public = "yes";
         }
      }*/
      mysqli_query("UPDATE '.$username.' SET dispDate='$dateApp',title='$titleApp',description='$data',startTime='$startTimeApp',endTime='$endTimeApp' WHERE date='$dispDate'");
      header("location:home.php");
   }
?>