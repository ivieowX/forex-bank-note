<?php
include 'db.php';

// ค่าตัวแปรที่ใช้ในการแบ่งหน้า
$limit = 10;  // จำนวนรายการต่อหน้า
$page = isset($_GET['page']) ? $_GET['page'] : 1; // หน้าที่แสดง
$offset = ($page - 1) * $limit;

// คำค้นหา
$search = isset($_GET['search']) ? $_GET['search'] : '';

// คำสั่ง SQL สำหรับการค้นหา
$sql = "SELECT * FROM banknotes WHERE country_name LIKE '%$search%' LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// ดึงข้อมูลทั้งหมดเพื่อใช้แสดงจำนวนหน้าทั้งหมด
$sqlCount = "SELECT COUNT(*) AS total FROM banknotes WHERE country_name LIKE '%$search%'";
$countResult = $conn->query($sqlCount);
$rowCount = $countResult->fetch_assoc();
$totalRecords = $rowCount['total'];
$totalPages = ceil($totalRecords / $limit);

// สร้าง Array ข้อมูลที่ต้องการส่งกลับ
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// ส่งข้อมูลกลับในรูปแบบ JSON
echo json_encode(['data' => $data, 'totalPages' => $totalPages]);
?>
