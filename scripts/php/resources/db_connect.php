<?php

require_once("config.php");

$servername = "localhost";
$dbname = "greenfield_local_hub";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    info_log("Database connected successfully.");
} catch(PDOException $error) {
    error_log("Connection failed: " . $error->getMessage());
}

?>
