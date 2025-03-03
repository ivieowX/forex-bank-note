<?php
session_start();
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // ดึงข้อมูลรูปภาพจากฐานข้อมูล
    $stmt = $conn->prepare("SELECT banknote_image_1, banknote_image_2, banknote_image_3, banknote_image_4, banknote_image_5 FROM banknotes WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $images = $result->fetch_assoc();

    // ส่งข้อมูลกลับเป็น JSON
    echo json_encode($images);
}
?>