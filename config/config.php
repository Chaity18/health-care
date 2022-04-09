<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=health_care", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return true;
} catch(PDOException $e) {
return false;
}

