<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>LMS</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<style>
    body {
      background-color: #f0f8ff;  
      font-family: Arial, sans-serif;
    }

    .navbar { 
      background-color: #343a40; 
      color: #fff; 
    }

    .navbar-brand { 
      font-size: 1.7em;
      font-weight: bold;
      color: #007bff;
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

    h3, h5 { 
      margin-bottom: 15px;
      color: #343a40;
    }

    .form-group { 
      margin-bottom: 15px; 
    }

    .form-control { 
      background-color: #ADD8E6; 
      border-color: #ccc; 
      color: #343a40; 
      padding: 10px 20px; 
    }

    .btn-primary { 
      background-color: #007bff;
      border-color: #007bff; 
      color: #fff; 
      padding: 10px 20px; 
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
      background-color: #343a40; 
      color: #fff;
    }
  </style>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">Library Management System (LMS)</a>
			</div>
	
		    <ul class="nav navbar-nav navbar-right">
		      <li class="nav-item">
		        <a class="nav-link" href="admin/index.php">Admin Login</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="signup.php"></span>Register</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="index.php">Login</a>
		      </li>
		    </ul>
		</div>
	</nav><br>
	<span><marquee>This is library mangement system. Library opens at 8:00 AM and close at 8:00 PM</marquee></span><br><br>
	<div class="row">
		<div class="col-md-4" id="side_bar">
			<h5>Library Timing</h5>
			<ul>
				<li>Opening: 8:00 AM</li>
				<li>Closing: 8:00 PM</li>
				<li>(Sunday Off)</li>
			</ul>
			<h5>What We provide ?</h5>
			<ul>
				<li>Full furniture</li>
				<li>Free Wi-fi</li>
				<li>News Papers</li>
				<li>Discussion Room</li>
				<li>RO Water</li>
				<li>Peacefull Environment</li>
			</ul>
		</div>
		<div class="col-md-8" id="main_content">
			<center><h3><u>User Login Form</u></h3></center>
			<form action="" method="post">
				<div class="form-group">
					<label for="email">Email ID:</label>
					<input type="text" name="email" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" name="password" class="form-control" required>
				</div>
				<button type="submit" name="login" class="btn btn-primary">Login</button> |
				<a href="signup.php"> Not registered yet ?</a>	
			</form>

			
			<?php 
				if(isset($_POST['login'])){
					$server = 'localhost';
        $username = 'root';
        $password = 'root';
        $database = 'lms';
        $connection = new mysqli($server, $username, $password, $database, 3307) or die("not 
        connected");
					$query = "select * from users where email = '$_POST[email]'";
					$query_run = mysqli_query($connection,$query);
					while ($row = mysqli_fetch_assoc($query_run)) {
						if($row['email'] == $_POST['email']){
							if($row['password'] == $_POST['password']){
								$_SESSION['name'] =  $row['name'];
								$_SESSION['email'] =  $row['email'];
								$_SESSION['id'] =  $row['id'];
								header("Location: user_dashboard.php");
							}
							else{
								?>
								<br><br><center><span class="alert-danger">Wrong Password !!</span></center>
								<?php
							}
						}
					}
				}
			?>
		</div>
	</div>
</body>
</html>
