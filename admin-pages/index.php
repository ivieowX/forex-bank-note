<?php
session_start();

// ตรวจสอบว่าผู้ใช้ล็อคอินหรือไม่
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit(); // หยุดการทำงานทันทีถ้าไม่ได้ล็อคอิน
}
// เชื่อมต่อฐานข้อมูลด้วย MySQLi
$conn = new mysqli("localhost", "root", "", "banknotes_db"); // แก้ไขข้อมูลการเชื่อมต่อตามที่คุณใช้

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>ForexERP-Banknotes</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../css/adminpage.css">
</head>

<body class="bg-light">
    <nav class="nav d-flex justify-content-center align-items-center p-3 bg-white shadow-sm">
        <div class="container row align-items-center w-100">
            <div class="col-4 col-lg-3 d-flex justify-content-start ps-0">
                <img src="https://app.forex-erp.com/images/touch/android-192-192.png" class="" alt="Logo" style="width: 60px; height: auto;">
            </div>
            <div class="col-4 col-lg-6 d-flex justify-content-center">
                <h2 class="text-center mb-0">ForexERP</h2>
            </div>
            <div class="col-4 col-lg-3 d-flex justify-content-end pe-0">
                <a href="logout.php" class="btn btn-danger shadow rounded-pill"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </nav>
    <nav class="nav d-flex justify-content-between align-items-center p-3 bg-white  border">
        <div class="m-2"></div>
    </nav>
    <div class="container pt-3 ">
        <p>แดชบอร์ดแอดมิน</p>
        <h2 class="text-start">ตารางข้อมูลสกุลเงิน</h2>
        <div class="d-flex justify-content-end">

        </div>
        <!-- ช่องค้นหา -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <input type="text" id="search" class="form-control w-50" placeholder="ค้นหาประเทศ..." aria-label="Search">
            <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="fas fa-plus"></i> เพิ่มสกุลเงิน
            </button>
        </div>

        <table class="table table-hover table-bordered text-center bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>ชื่อสกุลเงิน</th>
                    <th>ธง</th>
                    <th>ธนบัตร</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.php';
                $result = $conn->query("SELECT * FROM banknotes");
                while ($row = $result->fetch_assoc()):
                ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td class="fw-bold"><?= $row['country_name'] ?></td>
                        <td>
                            <img src="<?= $row['flag_url'] ?>" width="60" height="40">
                        </td>
                        <td>
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <?php if (!empty($row["banknote_image_$i"])): ?>
                                    <img src="http://localhost/forex-bn/admin-pages/<?= $row["banknote_image_$i"] ?>"
                                        width="40" height="70" class="banknote-img"
                                        data-bs-toggle="modal" data-bs-target="#imageModal"
                                        data-image="http://localhost/forex-bn/admin-pages/<?= $row["banknote_image_$i"] ?>">
                                <?php endif; ?>
                            <?php endfor; ?>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-mb editBtn"
                                data-id="<?= $row['id'] ?>"
                                data-country="<?= $row['country_name'] ?>"
                                data-flag="<?= $row['flag_url'] ?>">
                                <i class="fas fa-edit"></i> แก้ไข
                            </button>
                            <button class="btn btn-danger btn-mb deleteBtn" data-id="<?= $row['id'] ?>">
                                <i class="fas fa-trash"></i> ลบ
                            </button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <!-- Modal สำหรับแสดงรูปภาพ -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">รูปธนบัตร</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <!-- Add Modal -->
    <div class="modal fade" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เพิ่มสกุลเงิน</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body modal-add">
                    <form id="addForm" enctype="multipart/form-data">
                        <input type="text" name="country_name" class="form-control mb-2" placeholder="ชื่อสกุลเงิน" required>
                        <input type="text" name="flag_url" class="form-control mb-2" placeholder="ลิงก์ธงประเทศ" required>

                        <label>เลือกรูปธนบัตร</label>
                        <div id="uploadContainer" class="m-3">
                            <!-- ช่องอัปโหลดรูปภาพแบบไดนามิก -->
                        </div>
                        <button type="button" class="btn btn-outline-primary w-100 mb-2" id="addImageButton">
                            <i class="fas fa-plus"></i> เพิ่มรูปภาพ
                        </button>

                        <button type="submit" class="btn btn-success w-100">บันทึก</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/add-data.js"></script>


    <!-- Edit Modal -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit"></i> แก้ไขธนบัตร</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="edit_id">
                        <input type="text" name="country_name" id="edit_country" class="form-control mb-2" required placeholder="ชื่อสกุลเงิน">
                        <input type="text" name="flag_url" id="edit_flag" class="form-control mb-2" required placeholder="ลิงก์ธงประเทศ">

                        <label class="fw-bold"><i class="fas fa-images"></i> อัปโหลดรูปใหม่</label>

                        <!-- ช่องอัปโหลดรูปภาพ -->
                        <div id="edit-images-container">
                            <!-- รูปที่ 1 -->
                            <div class="card shadow-sm p-2 mb-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <label class="fw-bold">รูปที่ 1</label>

                                    <span id="status_image_1" class="text-muted"></span>
                                    <button type="button" class="btn btn-outline-danger btn-sm delete-image-btn" data-image="banknote_image_1">
                                        <i class="fas fa-trash"></i> ลบ
                                    </button>
                                </div>
                                <div class="text-center">
                                    <img id="preview_image_1" src="" class="preview-img mt-2 d-none">
                                    <input type="file" name="banknote_image_1" class="form-control image-input mt-2" accept="image/*">
                                </div>
                            </div>

                            <!-- รูปที่ 2 -->
                            <div class="card shadow-sm p-2 mb-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <label class="fw-bold">รูปที่ 2</label>
                                    <span id="status_image_2" class="text-muted"></span>
                                    <button type="button" class="btn btn-outline-danger btn-sm delete-image-btn" data-image="banknote_image_2">
                                        <i class="fas fa-trash"></i> ลบ
                                    </button>
                                </div>
                                <div class="text-center">
                                    <img id="preview_image_2" src="" class="preview-img mt-2 d-none">
                                    <input type="file" name="banknote_image_2" class="form-control image-input mt-2" accept="image/*">
                                </div>
                            </div>

                            <!-- รูปที่ 3 -->
                            <div class="card shadow-sm p-2 mb-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <label class="fw-bold">รูปที่ 3</label>
                                    <span id="status_image_3" class="text-muted"></span>
                                    <button type="button" class="btn btn-outline-danger btn-sm delete-image-btn" data-image="banknote_image_3">
                                        <i class="fas fa-trash"></i> ลบ
                                    </button>
                                </div>
                                <div class="text-center">
                                    <img id="preview_image_3" src="" class="preview-img mt-2 d-none">
                                    <input type="file" name="banknote_image_3" class="form-control image-input mt-2" accept="image/*">
                                </div>
                            </div>

                            <!-- รูปที่ 4 -->
                            <div class="card shadow-sm p-2 mb-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <label class="fw-bold">รูปที่ 4</label>
                                    <span id="status_image_4" class="text-muted"></span>
                                    <button type="button" class="btn btn-outline-danger btn-sm delete-image-btn" data-image="banknote_image_4">
                                        <i class="fas fa-trash"></i> ลบ
                                    </button>
                                </div>
                                <div class="text-center">

                                    <input type="file" name="banknote_image_4" class="form-control image-input mt-2" accept="image/*">
                                </div>
                            </div>

                            <!-- รูปที่ 5 -->
                            <div class="card shadow-sm p-2 mb-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <label class="fw-bold">รูปที่ 5</label>
                                    <span id="status_image_5" class="text-muted"></span>
                                    <button type="button" class="btn btn-outline-danger btn-sm delete-image-btn" data-image="banknote_image_5">
                                        <i class="fas fa-trash"></i> ลบ
                                    </button>
                                </div>
                                <div class="text-center">
                                    <img id="preview_image_5" src="" class="preview-img mt-2 d-none">
                                    <input type="file" name="banknote_image_5" class="form-control image-input mt-2" accept="image/*">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-3">อัปเดต</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/edit-data.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modalImage = document.getElementById("modalImage");
            document.querySelectorAll(".banknote-img").forEach(img => {
                img.addEventListener("click", function() {
                    modalImage.src = this.getAttribute("data-image");
                });
            });
        });
        $(document).ready(function() {
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("tbody tr").filter(function() {
                    $(this).toggle($(this).find("td:nth-child(2)").text().toLowerCase().indexOf(value) > -1);
                });
            });

            $("#addForm").submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "add.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function() {
                        location.reload();
                    }
                });
            });

            $(".deleteBtn").click(function() {
                let itemId = $(this).data("id");

                Swal.fire({
                    title: "ยืนยันการลบ?",
                    text: "คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลนี้?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "gray",
                    confirmButtonText: "ใช่, ลบเลย!",
                    cancelButtonText: "ยกเลิก"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post("delete.php", {
                            id: itemId
                        }, function() {
                            Swal.fire({
                                title: "ลบสำเร็จ!",
                                text: "ข้อมูลถูกลบแล้ว",
                                icon: "success",
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        });
                    }
                });
            });


            $(document).ready(function() {
                // เมื่อคลิกปุ่มแก้ไข
                $(".editBtn").click(function() {
                    let id = $(this).data("id");
                    let country = $(this).data("country");
                    let flag = $(this).data("flag");

                    // เซ็ตค่าในฟอร์มแก้ไข
                    $("#edit_id").val(id);
                    $("#edit_country").val(country);
                    $("#edit_flag").val(flag);

                    // ดึงข้อมูลรูปภาพจากฐานข้อมูล
                    $.ajax({
                        type: "GET",
                        url: "get_images.php", // สร้างไฟล์นี้เพื่อดึงข้อมูลรูปภาพ
                        data: {
                            id: id
                        },
                        success: function(response) {
                            const images = JSON.parse(response);

                            // แสดงสถานะรูปภาพ
                            for (let i = 1; i <= 5; i++) {
                                const imageField = `banknote_image_${i}`;
                                const statusField = `#status_image_${i}`;
                                if (images[imageField]) {
                                    $(statusField).text("มีรูป").removeClass("text-muted").addClass("text-success");
                                } else {
                                    $(statusField).text("ไม่มีรูป").removeClass("text-success").addClass("text-muted");
                                }
                            }
                        }
                    });

                    // แสดง Modal
                    $("#editModal").modal("show");
                });

                // เมื่อคลิกปุ่มลบรูป
                $(document).on("click", ".delete-image-btn", function() {
                    const imageField = $(this).data("image"); // ชื่อฟิลด์รูปภาพ (เช่น banknote_image_1)
                    const id = $("#edit_id").val(); // ID ของธนบัตร

                    Swal.fire({
                        title: "ยืนยันการลบรูป?",
                        text: "คุณแน่ใจหรือไม่ว่าต้องการลบรูปภาพนี้?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "gray",
                        confirmButtonText: "ใช่, ลบเลย!",
                        cancelButtonText: "ยกเลิก"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "delete_image.php", // สร้างไฟล์นี้เพื่อลบรูปภาพ
                                data: {
                                    id: id,
                                    image_field: imageField
                                },
                                success: function(response) {
                                    Swal.fire({
                                        title: "ลบสำเร็จ!",
                                        text: "รูปภาพถูกลบแล้ว",
                                        icon: "success",
                                        timer: 1500,
                                        showConfirmButton: false
                                    }).then(() => {
                                        // อัปเดตสถานะรูปภาพใน Modal
                                        $(`#status_${imageField}`).text("ไม่มีรูป").removeClass("text-success").addClass("text-muted");
                                    });
                                }
                            });
                        }
                    });
                });

                // เมื่อส่งฟอร์มแก้ไข
                $("#editForm").submit(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: "edit.php",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function() {
                            location.reload();
                        }
                    });
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>