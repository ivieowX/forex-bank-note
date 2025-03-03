<?php
include 'db.php';

$id = $_POST['id'];

$sql = "DELETE FROM banknotes WHERE id=$id";
$conn->query($sql);
?>
