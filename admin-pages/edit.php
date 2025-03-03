<?php
include 'db.php';

$id = $_POST['id'];
$country_name = $_POST['country_name'];
$flag_url = $_POST['flag_url'];

$uploadDir = "uploads/";
$updateImage = "";

// ดึงข้อมูลรูปเก่า
$sql = "SELECT banknote_image_1, banknote_image_2, banknote_image_3, banknote_image_4, banknote_image_5 FROM banknotes WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// ฟังก์ชันสำหรับลบรูปเก่า
function deleteOldImage($oldImage) {
    if ($oldImage && file_exists($oldImage)) {
        unlink($oldImage); // ลบไฟล์รูปเก่า
    }
}

// ฟังก์ชันอัปโหลดไฟล์ใหม่
function uploadImage($fileKey) {
    global $uploadDir;
    if (!empty($_FILES[$fileKey]['name'])) {
        $filePath = $uploadDir . basename($_FILES[$fileKey]['name']);
        move_uploaded_file($_FILES[$fileKey]['tmp_name'], $filePath);
        return $filePath;
    }
    return null;
}

// อัปโหลดและอัปเดตข้อมูลรูปภาพ
if ($newImage1 = uploadImage('banknote_image_1')) {
    deleteOldImage($row['banknote_image_1']);
    $updateImage .= ", banknote_image_1 = '$newImage1'";
}

if ($newImage2 = uploadImage('banknote_image_2')) {
    deleteOldImage($row['banknote_image_2']);
    $updateImage .= ", banknote_image_2 = '$newImage2'";
}

if ($newImage3 = uploadImage('banknote_image_3')) {
    deleteOldImage($row['banknote_image_3']);
    $updateImage .= ", banknote_image_3 = '$newImage3'";
}

if ($newImage4 = uploadImage('banknote_image_4')) {
    deleteOldImage($row['banknote_image_4']);
    $updateImage .= ", banknote_image_4 = '$newImage4'";
}

if ($newImage5 = uploadImage('banknote_image_5')) {
    deleteOldImage($row['banknote_image_5']);
    $updateImage .= ", banknote_image_5 = '$newImage5'";
}

// อัปเดตข้อมูล
$sql = "UPDATE banknotes SET country_name='$country_name', flag_url='$flag_url' $updateImage WHERE id=$id";
$conn->query($sql);

echo "อัปเดตสำเร็จ!";
?>
