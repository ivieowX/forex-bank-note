<?php
session_start(); // เริ่ม Session

// ลบ Session ทั้งหมด
session_unset();
session_destroy();

// นำผู้ใช้กลับไปยังหน้าล็อคอิน
header("Location: login.php");
exit();
?>