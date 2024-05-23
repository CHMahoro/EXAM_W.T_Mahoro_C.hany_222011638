<?php
// Connection details
-
$host = "localhost";
$user = "MAHORO";
$pass = "Chany@123";
$database = "mahoro_chany_online negotiation skills workshops platform";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>