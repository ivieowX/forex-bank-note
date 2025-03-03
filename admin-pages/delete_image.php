<?php
include 'db.php'; // เชื่อมต่อฐานข้อมูล

if (isset($_POST['imagePath'])) {
    $imagePath = $_POST['imagePath'];

    // ลบไฟล์จากโฟลเดอร์
    $filePath = $_SERVER['DOCUMENT_ROOT'] . "/forex-bn/uploads" . $imagePath;
    if (file_exists($filePath)) {
        unlink($filePath); // ลบไฟล์

        // ลบข้อมูลจากฐานข้อมูล
        $stmt = $conn->prepare("UPDATE banknotes SET banknote_image_1 = NULL, banknote_image_2 = NULL, banknote_image_3 = NULL, banknote_image_4 = NULL, banknote_image_5 = NULL WHERE banknote_image_1 = ? OR banknote_image_2 = ? OR banknote_image_3 = ? OR banknote_image_4 = ? OR banknote_image_5 = ?");
        $stmt->bind_param("sssss", $imagePath, $imagePath, $imagePath, $imagePath, $imagePath);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $imageField = $_POST['image_field']; // ชื่อฟิลด์รูปภาพ (เช่น banknote_image_1)

    // ดึงชื่อไฟล์รูปภาพเก่าก่อนลบ
    $stmt = $conn->prepare("SELECT $imageField FROM banknotes WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($oldImage);
    $stmt->fetch();
    $stmt->close();

    // ลบไฟล์รูปภาพจากโฟลเดอร์
    if ($oldImage && file_exists("uploads/$oldImage")) {
        unlink("uploads/$oldImage");
    }

    // อัปเดตฐานข้อมูลให้ฟิลด์รูปภาพเป็น NULL
    $stmt = $conn->prepare("UPDATE banknotes SET $imageField = NULL WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    echo json_encode(["status" => "success"]);
}
$conn->close();
?>
