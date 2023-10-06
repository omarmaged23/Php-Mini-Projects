<?php
require_once __DIR__ . '/Connection.php';
$conn = new Connection();
$conn->deleteNoteById($_POST['id']);
header("location: index.php");
