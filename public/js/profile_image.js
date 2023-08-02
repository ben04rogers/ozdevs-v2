document.addEventListener("DOMContentLoaded", function () {
    const fileInput = document.getElementById('image');
    const uploadButton = document.getElementById('uploadButton');
    const profileImage = document.getElementById('profileImage');

    // Trigger file selection when the upload button is clicked
    uploadButton.addEventListener('click', function () {
        fileInput.click();
    });

    // Update the displayed image when a new image is selected
    fileInput.addEventListener('change', function () {
        const file = fileInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                profileImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
});
