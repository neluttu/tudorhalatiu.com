document.addEventListener('DOMContentLoaded', function() {
    // Selectează SVG-ul și butonul după clasa unică
    let mobileMenuToggle = document.querySelector('.mobileMenuToggle');
    let mobileMenuClose = document.querySelector('.mobileMenuClose');

    // Adaugă event listener pentru deschiderea meniului mobil
    mobileMenuToggle.addEventListener('click', function() {
        mobileHandler(true); // Apelează mobileHandler cu valoarea true pentru deschidere
    });

    // Adaugă event listener pentru închiderea meniului mobil
    mobileMenuClose.addEventListener('click', function() {
        mobileHandler(false); // Apelează mobileHandler cu valoarea false pentru închidere
    });
});

// Funcția pentru manipularea meniului mobil
function mobileHandler(val) {
    let mobileMenu = document.getElementById("mobileMenu");

    if (val) {
        document.body.classList.add('overflow-hidden');
        fadeIn(mobileMenu);
    } else {
        document.body.classList.remove('overflow-hidden');
        fadeOut(mobileMenu);
    }
}

// Funcție pentru a face fade out elementului
function fadeOut(el) {
    el.style.opacity = 1;
    (function fade() {
        if ((el.style.opacity -= 0.1) < 0) {
            el.style.display = "none";
        } else {
            requestAnimationFrame(fade);
        }
    })();
}

// Funcție pentru a face fade in elementului
function fadeIn(el, display) {
    el.style.opacity = 0;
    el.style.display = display || "flex";
    (function fade() {
        let val = parseFloat(el.style.opacity);
        if (!((val += 0.2) > 1)) {
            el.style.opacity = val;
            requestAnimationFrame(fade);
        }
    })();
}