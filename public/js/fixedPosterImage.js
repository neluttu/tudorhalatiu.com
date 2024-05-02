const stickyContainer = document.getElementById('stickyContainer');
const stickyOffset = 140;
window.addEventListener('scroll', function() {
    const scrollPosition = window.scrollY || window.pageYOffset;
    const windowWidth = window.innerWidth;
    const viewportHeight = window.innerHeight;
    if(viewportHeight >= 900) {
        if (scrollPosition >= stickyOffset) {
            stickyContainer.classList.add('relative');
            stickyContainer.classList.remove('sticky', 'top-0');
            console.log('fuic');
            if(windowWidth >= 768)
                stickyContainer.style.top = `${stickyOffset}px`;

        } else {
            stickyContainer.classList.remove('relative');
            stickyContainer.classList.add('sticky', 'top-0');
            stickyContainer.style.top = '0';
        }
    } else stickyContainer.classList.remove('md:sticky', 'md:top-0');
});