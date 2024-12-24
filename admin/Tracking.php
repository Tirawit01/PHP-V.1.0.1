<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tirawit";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$ip_address = $_SERVER['REMOTE_ADDR'];
$sql = "INSERT INTO page_views (ip_address) VALUES ('$ip_address')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
