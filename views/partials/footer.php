<footer class="w-full px-2 pb-10 mx-auto mt-20 mb-2 max-w-7xl">
    <div class="flex items-center w-full gap-10 px-2 text-sm justify-evenly sm:justify-end md:px-0 text-slate-600">
            <a href="/" class="hover:text-main-color" title="">Acasă</a>
            <a href="/shop" class="hover:text-main-color" title="">Shop</a>
            <a href="/despre" class="hover:text-main-color" title="">Despre</a>
            <a href="/contact" class="hover:text-main-color" title="">Contact</a>
    </div>
    <hr class="h-px my-6 bg-gray-200 border-0 grow">
    <div class="font-sans text-sm font-light leading-loose tracking-tight text-left text-slate-600">
        © TUDOR HALATIU EMPIRE SRL 2024 - Toate drepturile rezervate<br>
        Str. Dedradului nr. 16, Reghin, Județul Mureș<br>
        CIF: 44940912, RC: J26/1550/2021<br>
    </div>
    <div class="flex items-center justify-start gap-4 mt-8">
        <a href="tel:+40745576131" target="_blank" title="Contact telefon Tudor Halatiu" class="group">
            <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:stroke-main-color" width="28" height="28" viewBox="0 0 24 24" stroke-width="1" stroke="#65676d" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
                <line x1="15" y1="9" x2="20" y2="4"></line>
                <polyline points="15 5 15 9 19 9"></polyline>
            </svg>
        </a>

        <a href="https://www.instagram.com/tudor.halatiu/" title="Tudor Halațiu Instagram" target="_blank" class="group">
            <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:stroke-main-color" width="28" height="28" viewBox="0 0 24 24" stroke-width="1" stroke="#65676d" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <rect x="4" y="4" width="16" height="16" rx="4"></rect>
                <circle cx="12" cy="12" r="3"></circle>
                <line x1="16.5" y1="7.5" x2="16.5" y2="7.501"></line>
            </svg>
        </a>

        <a href="/termeni-si-conditii" class="font-sans font-light text-slate-600" title="">Termeni și condiții</a>

        <a href="/politica-confidentialitate" class="font-sans font-light text-slate-600" title="">Politică confidențialitate</a>
        
    </div>
</footer>
<script>
    let mobileMenu = document.getElementById("mobileMenu");
    
    function mobileHandler(val) {
        if (val) {
            document.body.classList.add('overflow-hidden');
            fadeIn(mobileMenu);
        } else {
            document.body.classList.remove('overflow-hidden');
            fadeOut(mobileMenu);
        }
    }

    function fadeOut(el) {
        el.style.opacity = 1;
        (function fade() {
            if ((el.style.opacity -= 0.1) < 0) el.style.display = "none";
            else requestAnimationFrame(fade);
        })();
    }
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
</script>

<!-- <div class="flex items-center justify-start w-full gap-8 py-6 pt-4 mx-auto border-t max-w-7xl sm:px-6 lg:px-8 border-slate-300">
        <? foreach (getLangLinks() as $key => $value) : ?>
        <? echo '<a href="'. $value .'" title="'. $key .'">'. $key .'</a>'; ?>
        <? endforeach; ?>
    </div> -->
</body>
</html>