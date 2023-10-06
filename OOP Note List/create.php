<?php
require_once __DIR__ . '/Connection.php';
$conn = new Connection();
$id = $_POST['id'] ?? '';
if ($id) {
  $conn->updateNote($id, $_POST);
} else {
  $conn->addNote($_POST);
}
header("location: index.php");
