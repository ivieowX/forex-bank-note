<?php
session_start();
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // ดึงข้อมูลรูปภาพจากฐานข้อมูล
    $stmt = $conn->prepare("SELECT * FROM banknotes WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    // ส่งข้อมูลกลับเป็น JSON
    echo json_encode($data);
}
?>