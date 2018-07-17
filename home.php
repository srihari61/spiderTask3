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
	?>
	<body>
<script type="text/javascript" src="library.js"></script>
<script type="text/javascript">
function getBookDetailsByISBN() {
  
  
  isbn = document.getElementById("ISBNSearch").value;  
  
  var url = "https://www.googleapis.com/books/v1/volumes?q=isbn:" + isbn;
  
  var response = UrlFetchApp.fetch(url);
  var results = JSON.parse(response);
  
  if (results.totalItems) {
    
    // There'll be only 1 book per ISBN
    var book = results.items[0];
    
    var title = (book["volumeInfo"]["title"]);
   
    var authors = (book["volumeInfo"]["authors"]);
    
    
    // For debugging
    Logger.log(book);
  
  }
function getBookDetailsByAuthor() {
 
  Sauthor = document.getElementById("AuthorSearch").value;
  
  var url = "https://www.googleapis.com/books/v1/volumes?q=inauthor:" + Sauthor;
  
  var response = UrlFetchApp.fetch(url);
  var results = JSON.parse(response);
  
  if (results.totalItems) {
    
    // There'll be only 1 book per ISBN
    var book = results.items[0];
    
    var title = (book["volumeInfo"]["title"]);
   
    var authors = (book["volumeInfo"]["authors"]);
    
    
    // For debugging
    Logger.log(book);
  
  }

  function getBookDetailsByTitle() {
  
  Stitle = document.getElementById("ISBNSearch").value; 
  
  var url = "https://www.googleapis.com/books/v1/volumes?q=intitle:" + Stitle;
  
  var response = UrlFetchApp.fetch(url);
  var results = JSON.parse(response);
  
  if (results.totalItems) {
    
    // There'll be only 1 book per ISBN
    var book = results.items[0];
    
    var title = (book["volumeInfo"]["title"]);
   
    var authors = (book["volumeInfo"]["authors"]);
    
    
    // For debugging
    Logger.log(book);
  
  }

</script>

		<h2>Home Page</h2>
		<p>Hello <?php Print "$user"?>!</p> <!--Displays user's name-->
		<a href="logout.php">Click here to logout</a><br/><br/>
		<form action="home.php" method="POST">                                          <!--Search By ISBN-->
			Search By ISBN:
		    ISBN:<input type="text" id="ISBNSearch"/><br/>

			<input type="submit" value="Search By ISBN" onclick="getBookDetailsByISBN()"/>
		</form>

		<form action="home.php" method="POST">                                          <!--Search By AuthorName-->
			Search By Author:
		    Author:<input type="text" id="AuthorSearch"/><br/>

			<input type="submit" value="Search By Author" onclick="getBookDetailsByAuthor()"/>
		</form>

		<form action="home.php" method="POST">                                          <!--Search By Title-->
			Search By ISBN:
		    ISBN:<input type="text" id="TitleSearch"/><br/>

			<input type="submit" value="Search By Title"/ onclick="getBookDetailsByTitle()">
		</form>






		<form action="add.php" method="POST">                                          <!--Add to library-->
			Add more to library: 
			
			Title:<input type="text" name="titleLib"/><br/>
			Author:<input type="text" name="authorLib"/><br/>
		    ISBN:<input type="text" name="ISBNLib"/><br/>

			<input type="submit" value="Add to Library"/>
		</form>
		<form action="add.php" method="POST">                                          <!--Add to Favourites-->
			Add more to favourites: 
			
			Title:<input type="text" name="titleFav"/><br/>
			Author:<input type="text" name="authorFav"/><br/>
		    ISBN:<input type="text" name="ISBNFav"/><br/>

			<input type="submit" value="Add to Favourites"/>
		</form>
		<h2 align="center">My list</h2>
		<table border="1px" width="100%"></table>
		<tr>
				<th>Title</th>
				<th>Author</th>
				<th>ISBN</th>
				
			</tr>
		</table>
		<?php
				GLOBAL $username=mysqli_real_escape_string($_POST['username']);
				mysqli_connect("localhost", "root","") or die(mysqli_error()); //Connect to server
				mysqli_select_db("spidertask3") or die("Cannot connect to database"); //connect to database
				$query = mysqli_query("Select * from '.$username. ReadBook'"); // SQL Query
				
				while($row = mysqli_fetch_array($query))	
				{
					
					Print "<tr>";
						Print '<td align="center">'. $row['title'] . "</td>";
						Print '<td align="center">'. $row['author'] . "</td>";
						Print '<td align="center">'. $row['ISBN']."</td>";
						Print '<td align="center"><a href="edit.php?id='. $row['dispDate'] .'">edit</a> </td>';
						Print '<td align="center"><a href="#" onclick="myFunction('.$row['dispDate'].')">delete</a> </td>';
						
					Print "</tr>";
				}
			?>


			<table border="1px" width="100%"></table>

			<tr>
				<th>Title</th>
				<th>Author</th>
				<th>ISBN</th>
				
			</tr>
		</table>
		<?php
				GLOBAL $username=mysqli_real_escape_string($_POST['username']);
				mysqli_connect("localhost", "root","") or die(mysqli_error()); //Connect to server
				mysqlii_select_db("spidertask3") or die("Cannot connect to database"); //connect to database
				$query = mysqli_query("Select * from '.$username. FavBook'"); // SQL Query
				
				while($row = mysqli_fetch_array($query))	
				{
					
					Print "<tr>";
						Print '<td align="center">'. $row['title'] . "</td>";
						Print '<td align="center">'. $row['author'] . "</td>";
						Print '<td align="center">'. $row['ISBN']."</td>";
						Print '<td align="center"><a href="edit.php?id='. $row['id'] .'">edit</a> </td>';
						Print '<td align="center"><a href="#" onclick="myFunction('.$row['id'].')">delete</a> </td>';
						
					Print "</tr>";
				}
			?>
		</table>
		<script>
			function myFunction(id)
			{
			var r=confirm("Are you sure you want to delete this record?");
			if (r==true)
			  {
			  	window.location.assign("delete.php?id=" + id);
			  }
			}
		</script>
	</body>
</html>
	