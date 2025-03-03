<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include 'db.php';

// ดึงข้อมูลสกุลเงินทั้งหมด
$result = $conn->query("SELECT * FROM banknotes");

$currencies = [];
while ($row = $result->fetch_assoc()) {
    $currencies[] = $row;
}

// ส่งข้อมูลกลับในรูปแบบ JSON
echo json_encode($currencies);
?>