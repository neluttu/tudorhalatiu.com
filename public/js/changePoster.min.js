document.addEventListener('DOMContentLoaded', function() {
    var imageElements = document.querySelectorAll('img.productImage');
    imageElements.forEach(function(img) {
        img.addEventListener('click', function() {
            var src = img.getAttribute('src');

            if (window.innerWidth >= 640) {
                const posterImg = document.getElementById('poster');
                posterImg.classList.remove('opacity-100'); 
                posterImg.classList.add('opacity-0');

                setTimeout(function() {
                    posterImg.src = src;
                    posterImg.classList.remove('opacity-0');
                    posterImg.classList.add('opacity-100');
                    if (window.innerWidth <= 768) posterImg.scrollIntoView({ behavior: 'smooth' });
                }, 300);
            }
        });
    });
});