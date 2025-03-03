document.addEventListener("DOMContentLoaded", function() {
    // ฟังก์ชันแสดงภาพตัวอย่าง
    document.querySelectorAll(".image-input").forEach(input => {
        input.addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                const previewId = event.target.name.replace("banknote_", "preview_");
                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                    document.getElementById(previewId).classList.remove("d-none");
                };
                reader.readAsDataURL(file);
            }
        });
    });

    // ฟังก์ชันลบรูป
    document.querySelectorAll(".delete-image-btn").forEach(button => {
        button.addEventListener("click", function() {
            const imageName = button.getAttribute("data-image");
            const previewId = imageName.replace("banknote_", "preview_");
            document.getElementById(previewId).src = "";
            document.getElementById(previewId).classList.add("d-none");
        });
    });
});