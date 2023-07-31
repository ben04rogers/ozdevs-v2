// Update the displayed image when a new image is selected
const fileInput = document.getElementById('image');
const profileImage = document.getElementById('profileImage');

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
