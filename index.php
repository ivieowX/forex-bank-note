<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forex Bank Note</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./styles.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div id="currencyCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="9000"
                data-bs-touch="true">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="image/money3.png" class="d-block w-100 rounded shadow-lg" alt="Currency Image"
                            style="object-fit: cover; height: 300px;">
                    </div>
                    <div class="carousel-item">
                        <img src="image/money2.png" class="d-block w-100 rounded shadow-lg" alt="Currency Image 2"
                            style="object-fit: cover; height: 300px;">
                    </div>
                    <div class="carousel-item">
                        <img src="image/money1.png" class="d-block w-100 rounded shadow-lg" alt="Currency Image 3"
                            style="object-fit: cover; height: 300px;">
                    </div>
                    <div class="carousel-item">
                        <img src="image/money4.png" class="d-block w-100 rounded shadow-lg" alt="Currency Image 4"
                            style="object-fit: cover; height: 300px;">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#currencyCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#currencyCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div class="currency-section text-center">
                <h1 class="title">สกุลเงินต่างประเทศ Currency</h1>
                <div class="input-group mb-2">
                    <span class="input-group-text bg-primary text-white">
                        <i class="fa fa-search"> ค้นหา</i>
                    </span>
                    <input type="text" id="searchInput" class="form-control" placeholder="ค้นหาสกุลเงิน..." onkeyup="filterCurrencies()">
                </div>
                <div id="currency-buttons" class="row">
                    <!-- ปุ่มสกุลเงินจะถูกเพิ่มที่นี่โดย JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="currencyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="currencyTitle">Currency Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center" id="currencyImages">
                    <!-- รูปภาพจะถูกเพิ่มเข้าไปที่นี่ -->
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ฟังก์ชันสำหรับดึงข้อมูลจาก API
        async function fetchCurrencies() {
            try {
                const response = await fetch('http://localhost/forex-bn/admin-pages/api.php'); // เปลี่ยนเป็น URL จริงหากต้องการใช้งานออนไลน์
                const currencies = await response.json();

                const currencyButtons = document.getElementById('currency-buttons');
                currencyButtons.innerHTML = ''; // ล้างข้อมูลก่อนแสดงผล

                currencies.forEach(currency => {
                    const col = document.createElement('div');
                    col.className = 'col-md-2 col-sm-4 col-6 text-center';
                    col.innerHTML = `
                <button class="currency-btn shadow-sm p-2" onclick="showCurrencyImage(
                    '${currency.banknote_image_1 ? `http://localhost/forex-bn/admin-pages/${currency.banknote_image_1}` : ''}',
                    '${currency.banknote_image_2 ? `http://localhost/forex-bn/admin-pages/${currency.banknote_image_2}` : ''}',
                    '${currency.banknote_image_3 ? `http://localhost/forex-bn/admin-pages/${currency.banknote_image_3}` : ''}',
                    '${currency.banknote_image_4 ? `http://localhost/forex-bn/admin-pages/${currency.banknote_image_4}` : ''}',
                    '${currency.banknote_image_5 ? `http://localhost/forex-bn/admin-pages/${currency.banknote_image_5}` : ''}',
                    '${currency.country_name}'
                )">
                    <img src="${currency.flag_url}" alt="${currency.country_name} Flag" class="currency-flag mb-1">
                    <span class="d-block">${currency.country_name}</span>
                </button>
            `;
                    currencyButtons.appendChild(col);
                });
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }


        // ฟังก์ชันสำหรับแสดงรูปภาพใน Modal
        function showCurrencyImage(imageSrc1, imageSrc2, imageSrc3, imageSrc4, imageSrc5, currencyName) {
            let imageContainer = document.getElementById('currencyImages');
            let currencyTitle = document.getElementById('currencyTitle');

            imageContainer.innerHTML = ''; // ล้างรูปภาพเก่า
            currencyTitle.innerText = currencyName; // ตั้งชื่อสกุลเงินใน Modal

            [imageSrc1, imageSrc2, imageSrc3, imageSrc4, imageSrc5].forEach(src => {
                if (src) { // เช็คก่อนว่าไม่ใช่ค่าว่าง
                    let imgElement = document.createElement('img');
                    imgElement.src = src;
                    imgElement.classList.add('img-fluid', 'rounded', 'shadow', 'm-2');
                    imgElement.style.maxWidth = '100%';
                    imageContainer.appendChild(imgElement);
                }
            });

            var myModal = new bootstrap.Modal(document.getElementById('currencyModal'));
            myModal.show();
        }

        function filterCurrencies() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let buttons = document.querySelectorAll("#currency-buttons .col-md-2");

            buttons.forEach(btn => {
                let text = btn.textContent.toLowerCase();
                if (text.includes(input)) {
                    btn.style.display = "block";
                } else {
                    btn.style.display = "none";
                }
            });
        }

        // เรียกฟังก์ชันเมื่อหน้าเว็บโหลดเสร็จ
        document.addEventListener('DOMContentLoaded', fetchCurrencies);
    </script>
</body>

</html>