<?php
	session_start();
	function get_user_issue_book_count(){
		$server = 'localhost';
        $username = 'root';
        $password = 'root';
        $database = 'lms';
        $connection = new mysqli($server, $username, $password, $database, 3307) or die("not 
        connected");
		$user_issue_book_count = 0;
		$query = "select count(*) as user_issue_book_count from issued_books where student_id = $_SESSION[id]";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$user_issue_book_count = $row['user_issue_book_count'];
		}
		return($user_issue_book_count);
	}
$server = 'localhost';
        $username = 'root';
        $password = 'root';
        $database = 'lms';
        $connection = new mysqli($server, $username, $password, $database, 3307) or die("not 
        connected");
	$book_name = "";
	$author = "";
	$category = "";
	$book_no = "";
	$price = "";
	$query = "select books.book_name,books.book_no,book_price,authors.author_name from books left join authors on books.author_id = authors.author_id";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
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
  color: #800000; 
}

#side_bar, #main_content {
  padding: 20px;
  border-radius: 5px; 
  box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1); 
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
  padding: 15px 0;
}

</style>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="admin_dashboard.php">Library Management System (LMS)</a>
			</div>
			<font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['name'];?></strong></span></font>
			<font style="color: white"><span><strong>Email: <?php echo $_SESSION['email'];?></strong></font>
		    <ul class="nav navbar-nav navbar-right">
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">My Profile </a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="view_profile.php">View Profile</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="edit_profile.php">Edit Profile</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="change_password.php">Change Password</a>
	        	</div>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="logout.php">Logout</a>
		      </li>
		    </ul>
		</div>
	</nav><br>
	<span><marquee>This is library mangement system. Library opens at 8:00 AM and close at 8:00 PM</marquee></span><br><br>
	<div class="row">
		<div class="col-md-3" style="margin: 25px">
			<div class="card bg-light" style="width: 300px">
				<div class="card-header">Book Issued</div>
				<div class="card-body">
					<p class="card-text">No of book issued: ></p>
					<a class="btn btn-success" href="va_issue.php">View Issued Books</a>
				</div>
			</div>
			<div class="col-md-3" style="margin: 25px">
			<div class="card bg-light" style="width: 300px">
				<div class="card-header">See All Books</div>
				<div class="card-body">
					<p class="card-text">Explore books </p>
					<a class="btn btn-success" href="./regi_book.php">View  Books</a>
				</div>
			</div>
		</div>
		<div class="col-md-3"></div>
		<div class="col-md-3"></div>
	</div>
<!--  -->
	<!-- <center><h4>Registered Book's Detail</h4><br></center> -->
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				
			</div>
			<div class="col-md-2"></div>
		</div>
</body>
</html>