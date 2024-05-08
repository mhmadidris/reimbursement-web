document.addEventListener('DOMContentLoaded', function () {
    const imageUploadInput = document.getElementById('imageUpload');
    const imagePreview = document.getElementById('imagePreview');

    const imageUploadInputEdit = document.getElementById('imageUploadEdit');
    const imagePreviewEdit = document.getElementById('imagePreviewEdit');

    imageUploadInput.addEventListener('change', function () {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.src = e.target.result;
            };

            reader.readAsDataURL(file);
        } else {
            imagePreview.src = "{{ asset('images/upload-image.png') }}";
        }
    });

    imageUploadInputEdit.addEventListener('change', function () {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreviewEdit.src = e.target.result;
            };

            reader.readAsDataURL(file);
        } else {
            imagePreviewEdit.src = "{{ asset('images/upload-image.png') }}";
        }
    });
});