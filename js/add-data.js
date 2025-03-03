document.addEventListener("DOMContentLoaded", function() {
    let uploadContainer = document.getElementById("uploadContainer");
    let addImageButton = document.getElementById("addImageButton");
    let maxImages = 5;
    let imageCount = 0;

    function createImageUploadField(index) {
        let div = document.createElement("div");
        div.classList.add("mb-3", "image-upload");
        div.innerHTML = `
    <div class="card shadow-sm p-3 mb-2 rounded border">
        <div class="d-flex align-items-center justify-content-between">
            <label class="fw-bold">รูปที่ ${index} </label>
            <button type="button" class="btn btn-outline-danger btn-sm remove-image-btn">
                <i class="fas fa-trash"></i> ลบ
            </button>
        </div>
        <div class="text-center mt-2">
            <label for="image-upload-${index}" class="upload-box d-flex align-items-center justify-content-center">
                <i class="fas fa-upload fa-2x text-muted"></i>
                <span class="ms-2 text-muted">เลือกไฟล์</span>
            </label>
            <input type="file" id="image-upload-${index}" name="banknote_image_${index}" 
                class="form-control image-input d-none" accept="image/*" required>
            <img src="" class="preview-img mt-2 d-none" style="max-width: 100px; border-radius: 5px;">
        </div>
    </div>
`;
        uploadContainer.appendChild(div);

        let inputFile = div.querySelector(".image-input");
        let previewImg = div.querySelector(".preview-img");
        let removeBtn = div.querySelector(".remove-image-btn");

        inputFile.addEventListener("change", function(event) {
            if (event.target.files.length > 0) {
                let file = event.target.files[0];
                let reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImg.classList.remove("d-none");
                };
                reader.readAsDataURL(file);
            }
        });

        removeBtn.addEventListener("click", function() {
            div.remove();
            imageCount--;
            if (imageCount < maxImages) {
                addImageButton.classList.remove("disabled");
            }
        });

        imageCount++;
        if (imageCount >= maxImages) {
            addImageButton.classList.add("disabled");
        }
    }

    addImageButton.addEventListener("click", function() {
        if (imageCount < maxImages) {
            createImageUploadField(imageCount + 1);
        }
    });

    // สร้างช่องแรกโดยอัตโนมัติ
    createImageUploadField(1);
});