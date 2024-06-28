<?php
$server = 'localhost';
        $username = 'root';
        $password = 'root';
        $database = 'lms';
        $connection = new mysqli($server, $username, $password, $database, 3307) or die("not 
        connected");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs to prevent SQL injection
    $name = $connection->real_escape_string($_POST['name']);
    $email = $connection->real_escape_string($_POST['email']);
    $password = $connection->real_escape_string($_POST['password']);
    $mobile = $connection->real_escape_string($_POST['mobile']);
    $address = $connection->real_escape_string($_POST['address']);

    // Check if email already exists in the database
    $check_query = "SELECT * FROM users WHERE email = '$email'";
    $check_result = $connection->query($check_query);
    if ($check_result->num_rows > 0) {
        // Email already exists, display error message
        echo '<script type="text/javascript">
            alert("Email already exists. Please choose a different email.");
            window.location.href = "signup.php"; // Redirect to registration page
        </script>';
    } else {
        // Email does not exist, proceed with registration
        $query = "INSERT INTO users (name, email, password, mobile, address) 
                  VALUES ('$name', '$email', '$password', '$mobile', '$address')";
        $query_run = $connection->query($query);
        if ($query_run) {
            // Registration successful, redirect to login page
            echo '<script type="text/javascript">
                alert("Registration successful. You may login now!");
                window.location.href = "index.php"; // Redirect to login page
            </script>';
        } 
    }

} 
?>
