<?php
include 'db.php';

$country_name = $_POST['country_name'];
$flag_url = $_POST['flag_url'];

// สำหรับอัปโหลดรูปธนบัตร
$banknote_image_1 = null;
$banknote_image_2 = null;
$banknote_image_3 = null;
$banknote_image_4 = null;
$banknote_image_5 = null;

// ตรวจสอบและอัปโหลดรูปแรก
if (isset($_FILES['banknote_image_1']) && $_FILES['banknote_image_1']['error'] == 0) {
    $banknote_image_1 = 'uploads/' . $_FILES['banknote_image_1']['name'];
    move_uploaded_file($_FILES['banknote_image_1']['tmp_name'], $banknote_image_1);
}

// ตรวจสอบและอัปโหลดรูปที่สอง
if (isset($_FILES['banknote_image_2']) && $_FILES['banknote_image_2']['error'] == 0) {
    $banknote_image_2 = 'uploads/' . $_FILES['banknote_image_2']['name'];
    move_uploaded_file($_FILES['banknote_image_2']['tmp_name'], $banknote_image_2);
}

// ตรวจสอบและอัปโหลดรูปที่สาม
if (isset($_FILES['banknote_image_3']) && $_FILES['banknote_image_3']['error'] == 0) {
    $banknote_image_3 = 'uploads/' . $_FILES['banknote_image_3']['name'];
    move_uploaded_file($_FILES['banknote_image_3']['tmp_name'], $banknote_image_3);
}

// ตรวจสอบและอัปโหลดรูปที่สี่
if (isset($_FILES['banknote_image_4']) && $_FILES['banknote_image_4']['error'] == 0) {
    $banknote_image_4 = 'uploads/' . $_FILES['banknote_image_4']['name'];
    move_uploaded_file($_FILES['banknote_image_4']['tmp_name'], $banknote_image_4);
}

// ตรวจสอบและอัปโหลดรูปที่ห้า
if (isset($_FILES['banknote_image_5']) && $_FILES['banknote_image_5']['error'] == 0) {
    $banknote_image_5 = 'uploads/' . $_FILES['banknote_image_5']['name'];
    move_uploaded_file($_FILES['banknote_image_5']['tmp_name'], $banknote_image_5);
}

// บันทึกข้อมูลลงฐานข้อมูล
$query = "INSERT INTO banknotes (country_name, flag_url, banknote_image_1, banknote_image_2, banknote_image_3, banknote_image_4, banknote_image_5) 
          VALUES ('$country_name', '$flag_url', '$banknote_image_1', '$banknote_image_2', '$banknote_image_3', '$banknote_image_4', '$banknote_image_5')";
$conn->query($query);

echo "บันทึกข้อมูลเรียบร้อย";
?>
