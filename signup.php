<!DOCTYPE html>
<html>
<head>
    <title>LMS</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap-4.4.1/js/jquery_latest.js"></script>
    <script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
    /* Body and Header (assuming they share a color) */
    body,
    .navbar { /* Target navbar if it's used */
      background-color: #343a40; /* Dark blue color (adjust as needed) */
      color: #fff; /* White text for body and header elements */
    }

    /* Main content (soft peach) */
    #main_content {
      padding: 50px;
      background-color: #f5e2d6; 
      color: #000;
    }

    /* Side bar (matching body and header) */
    #side_bar {
      background-color: #343a40; /* Same color as body and header */
      padding: 50px;
      width: 300px;
      height: 450px;
    }

    #side_bar h5 {
      margin-bottom: 15px;
      color: #fff; /* White text for headings in sidebar */
    }

    #side_bar ul {
      list-style: none; /* Remove default bullet points */
      padding: 0; /* Remove default padding */
      margin: 0; /* Remove default margin */
    }

    #side_bar li {
      margin-bottom: 10px; /* Spacing between list items */
      color: #fff; /* White text for list items in sidebar */
    }
  </style>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Library Management System (LMS)</a>
            </div>
        
            <ul class="nav navbar-nav navbar-right">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Admin Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"></span>Register</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php">Login</a>
              </li>
            </ul>
        </div>
    </nav><br>
    <span><marquee>This is library management system. Library opens at 8:00 AM and close at 8:00 PM</marquee></span><br><br>
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
                <li>Peaceful Environment</li>
            </ul>
        </div>
        <div class="col-md-8" id="main_content">
            <center><h3><u>User Registration Form</u></h3></center>
            <form id="registration_form" action="send.php" method="post" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="name">Full Name:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email ID:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" onkeyup="checkPasswordMatch()" required>
                    <div class="registration_password_match" id="registration_password_match"></div>
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile:</label>
                    <input type="text" name="mobile" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea name="address" class="form-control" required></textarea> 
                </div>
                <button type="submit" id="register_button" class="btn btn-primary">Register</button>    
            </form>
            <!-- Add "Sign up with Google" button -->
            <div>
                <center><h5>Or</h5></center>
                <center><a href="google.php" class="btn btn-danger">Sign up with Google</a></center>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirm_password = document.getElementById("confirm_password").value;

            if (password != confirm_password) {
                alert("Passwords do not match!");
                return false;
            }
            return true;
        }

        function checkPasswordMatch() {
            var password = document.getElementById("password").value;
            var confirm_password = document.getElementById("confirm_password").value;

            if (password != confirm_password) {
                document.getElementById("registration_password_match").innerHTML = "Passwords do not match!";
                document.getElementById("register_button").disabled = true;
            } else {
                document.getElementById("registration_password_match").innerHTML = "";
                document.getElementById("register_button").disabled = false;
            }
        }
    </script>
</body>
</html>
