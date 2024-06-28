<?php
	session_start();
	#fetch data from database
	$server = 'localhost';
        $username = 'root';
        $password = 'root';
        $database = 'lms';
        $connection = new mysqli($server, $username, $password, $database, 3307) or die("not 
        connected");
	// 
    $search_term = "";
  if(isset($_GET['search_term'])) {
      $search_term = mysqli_real_escape_string($connection, $_GET['search_term']); // Sanitize user input
  }

  $query = "select books.book_name,books.book_no,book_price,authors.author_name from books left join authors on books.author_id = authors.author_id";

  if (!empty($search_term)) {
      $query .= " WHERE (books.book_name LIKE '%$search_term%' OR authors.author_name LIKE '%$search_term%')";
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>All Reg Books</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<style>
	body {
  background-color: #f5f5f5;
  font-family: Arial, sans-serif;
}

.navbar {
  background-color: #343a40;
  color: #fff;
}

.navbar-brand {
  font-size: 1.7em;
  font-weight: bold;
}

.nav-link {
  color: #fff;
  padding: 10px 15px;
}

.nav-link:hover {
  background-color: #282c33;
}

.marquee {
  font-size: 1.1em;
  color: #800000; /* Changed to a darker red */
}

#side_bar, #main_content {
  padding: 20px;
  border-radius: 5px; /* Reduced border radius for a cleaner look */
  box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1); /* Lighter shadow */
}

h3, h5 {
  margin-bottom: 15px;
}

.form-group {
  margin-bottom: 20px;
}

.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
}

.btn-primary:hover {
  background-color: #0069d9;
  border-color: #0062cc;
}

.alert-danger {
  padding: 10px;
  border-radius: 5px;
  color: #fff;
  background-color: #dc3545;
}

footer {
  padding: 15px 0; /* Reduced padding for a more compact footer */
}

.search-box {
  display: flex; /* Make search box elements display inline */
  align-items: center; /* Vertically center elements */
}

.search-input {
  width: 40%; /* Stretch input to fill container width */
  border-radius: 5px; /* Add rounded corners */
  border: 1px solid #ccc; /* Add a light border */
  padding: 5px 10px; /* Add some padding */
  font-size: 16px; /* Increase font size for better readability */
}

.search-btn {
  margin-left: 10px; /* Add some space between input and button */
  background-color: #007bff; /* Set button color */
  border-color: #007bff; /* Set button border color */
  color: #fff; /* Set button text color */
  padding: 5px 10px; /* Add some button padding */
  border-radius: 5px; /* Add rounded corners to button */
}


</style>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
		
	</nav><br>
		<center><h4>Total Book's Detail</h4><br></center>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<form>
                     <div class="form-group search-box">
    <label for="search_term">Search Books:</label>
    <input type="text" class="form-control search-input" id="search_term" name="search_term" placeholder="Enter book name or author">
    <button type="submit" class="btn btn-primary search-btn">Search</button>
  </div>
					<table class="table-bordered" width="900px" style="text-align: center">
						<tr>
							<th>Name</th>
							<th>Author</th>
							<th>Price</th>
							<th>Number</th>
						</tr>
				
					<?php
						$query_run = mysqli_query($connection,$query);
						while ($row = mysqli_fetch_assoc($query_run)){
							?>
							<tr>
							<td><?php echo $row['book_name'];?></td>
							<td><?php echo $row['author_name'];?></td>
							<td><?php echo $row['book_price'];?></td>
							<td><?php echo $row['book_no'];?></td>
						</tr>

					<?php
						}
					?>	
				</table>
				</form>
			</div>
			<div class="col-md-2"></div>
		</div>
</body>
</html>
