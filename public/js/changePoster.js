document.addEventListener('DOMContentLoaded', function() {
    const imageElements = document.querySelectorAll('img.productImage');
    imageElements.forEach(function(img) {
        img.addEventListener('click', function() {
            const src = img.getAttribute('src');
            const posterImg = document.getElementById('poster');

            if (window.innerWidth >= 640 && src != posterImg.getAttribute('src')) {
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