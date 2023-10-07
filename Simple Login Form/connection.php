<?php
$hostname = "localhost";
$dbname = "users";
$dbuser = "root";
$dbpass = "root";

try {
  $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $dbuser, $dbpass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
}
