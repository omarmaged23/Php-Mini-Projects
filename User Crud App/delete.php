<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $hostname = "localhost";
  $username = "root";
  $pass = "root";
  $database = "my_db";
  $conn = new PDO("mysql:hostname=$hostname;dbname=$database", $username, $pass);
  $sql = "DELETE From clients WHERE id=$id";
  $conn->query($sql);
}
header("location: index.php");
exit;
