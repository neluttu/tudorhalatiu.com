document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('fileInput');
    const fileNameElement = document.getElementById('fileName');

    if (fileInput && fileNameElement) {
        fileInput.addEventListener('change', function() {
            const fileName = this.files[0].name;
            fileNameElement.textContent = fileName;
        });

        const fileInputWrapper = document.querySelector('.file-input-wrapper');
        if (fileInputWrapper) {
            fileInputWrapper.addEventListener('click', function() {
                fileInput.click();
            });
        } else {
            console.error('Elementul .file-input-wrapper nu a fost găsit în DOM.');
        }
    } else {
        console.error('Elementele fileInput sau fileNameElement nu au fost găsite în DOM.');
    }
});
