<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function


// $address=$_POST["address"];

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


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

require 'vendor/autoload.php';

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    echo json_encode(array('error' => 'Invalid request method'));
    exit();
}


function generateOTP() {
    $length = 6;
    $characters = '0123456789';
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $otp;
}


//Load Composer's autoloader


//Create an instance; passing `true` enables exceptions
function sendOTPEmail($email,$otp){


$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;     
    $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);                              //Enable SMTP authentication
    $mail->Username   = 'rahmansaif.413@gmail.com';                     //SMTP username
    $mail->Password   = 'nvkd srnz kyqm ysgi';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587; 
    
    
//     $mail->SMTPOptions = array(
//     'ssl' => array(
//         'verify_peer' => false,
//         'verify_peer_name' => false,
//         'allow_self_signed' => true
//     )
// ); 



    
    $name=$_POST["name"];
$email=$_POST["email"];
$password=$_POST["password"];
$mobile=$_POST["mobile"];
//TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('rahmansaif.413@gmail.com','now');
    $mail->addAddress($email);     //Add a recipient


    

    //Attachments
  //Optional name

    //Content
    $otp = generateOTP();

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Your OTP Code';
    $mail->Body    = "Your OTP code is <b>$otp</b>" ;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    return 'otp has been sent';
}
     catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}


$msg = sendOTPEmail($_POST['email'], $otp);
if($msg=='OTP has been sent'){
    $expiry_time = date('Y-m-d H:i:s', strtotime('+5 minutes'));

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "lms";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname,3307);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST['email'];
$sql = "INSERT INTO otp_records (email, otp, expiry_time)
    VALUES ('$email', '$otp', '$expiry_time')";

    $response = array();

    if ($conn->query($sql) === TRUE) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['error'] = $conn->error;
    }

    $conn->close();
    header("Location: verify.php?email=" . urlencode($email));
    exit();

    // echo json_encode(array('Mailer message: ' => $msg, 'Response: ' => $response));
} else {
        header("Location: verify.php?email=" . urlencode($email));

    echo json_encode(array('Mailer message: '=>$msg));
}
?>