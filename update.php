<?php
	 $server = 'localhost';
        $username = 'root';
        $password = 'root';
        $database = 'lms';
        $connection = new mysqli($server, $username, $password, $database, 3307) or die("not 
        connected");
	$query = "update users set name = '$_POST[name]',email = '$_POST[email]',mobile = '$_POST[mobile]',address = '$_POST[address]'";
	$query_run = mysqli_query($connection,$query);
?>
<script type="text/javascript">
	alert("Updated successfully...");
	window.location.href = "user_dashboard.php";
</script>