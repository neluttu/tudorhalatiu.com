<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>


<main class="w-full px-2 max-w-7xl">
        <div class="flex flex-wrap items-start justify-start gap-8">
        <div class="w-full md:flex-1">
            <ul class="flex flex-col w-full mt-10 text-base gap-y-3 odd:[&>li]:bg-gray-50 even:[&>li]:bg-white rounded-lg">
                <li class="flex items-start justify-start p-2 font-light gap-x-5">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" class="w-8 h-8 text-main-color">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span class="leading-relaxed">
                        <p class="font-normal text-main-color">Telefon contact</p>
                        <a href="tel:+40754784303" class="hover:text-main-color hover:underline" title="Telefon contact SenoMEDICA Târgu Mureș">+4 0754 784 303</a>
                    </span>
                </li>
                <li class="flex items-start justify-start p-2 font-light gap-x-5">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" class="w-8 h-8 text-main-color">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span class="leading-relaxed">
                        <p class="font-normal text-main-color">Adresă email</p>
                        <a class="hover:text-main-color hover:underline" href="#" title="Email SenoMEDICA">contact @ tudorhalatiu . com</a>
                    </span>
                </li>
                <li class="flex items-start justify-start p-2 font-light gap-x-5">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" class="w-8 h-8 text-main-color">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                    </svg>
                    <span class="leading-relaxed">
                        <p class="font-normal text-main-color">Pagina Facebook</p>
                        <a href="https://www.facebook.com/tudor.halatiu" class="hover:text-main-color hover:underline" target="_blank" title="SenoMEDICA - pagina oficială Facebook">facebook.com/tudor.halatiu</a>
                    </span>
                </li>
                <li class="flex items-start justify-start p-2 font-light gap-x-5">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" class="w-8 h-8 text-main-color">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" />
                        <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M16.5 7.5l0 .01" />
                    </svg>
                    <span class="leading-relaxed">
                        <p class="font-normal text-main-color">Cont Instagram</p>
                        <a href="https://www.instagram.com/tudor.halatiu/" target="_blank" title="SenoMEDICA - cont instagram">instagram.com/tudor.halatiu</a>
                    </span>
                </li>
                <li class="flex items-start justify-start p-2 font-light gap-x-5">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" class="w-8 h-8 text-main-color">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="leading-relaxed">
                        <p class="font-normal text-main-color">Adresa noastră</p>
                        Str. Dedradului nr. 16, Reghin, Județul Mureș
                    </span>
                </li>
                
            </ul>
        </div>
        <form class="w-full p-6 rounded-lg bg-gray-50 md:flex-1" method="post" action="/contact-senomedica" id="contact">
                <div class="-mx-2 md:items-center md:flex">
                    <div class="flex-1 px-2">
                        <label for="name" class="block mb-2 text-base text-gray-600">Numele tău</label>
                        <input id="name" value="" name="name" type="text" placeholder="Popescu Maria" class="block w-full px-5 py-2.5 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg focus:outline-none"  />
                        <small class="text-red-400"></small>
                    </div>
                </div>

                <div class="mt-4">
                    <label for="email" class="block mb-2 text-base text-gray-600">Adresa de email</label>
                    <input id="email" value="" name="email" type="email" placeholder="adresa@email.ro" class="block w-full px-5 py-2.5 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg focus:outline-none"  />
                    <small class="text-red-400"></small>
                </div>
                
                <div class="mt-4">
                    <label for="phone" class="block mb-2 text-base text-gray-600">Număr telefon</label>
                    <input id="phone" type="text" name="phone" value="" placeholder="Telefonul tău" class="block w-full px-5 py-2.5 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg focus:outline-none"  />
                    <small class="text-red-400"></small>
                </div>
                
                <div class="hidden mt-4">
                    <label for="work_phone" class="block mb-2 text-base text-gray-600">Număr telefon</label>
                    <input id="work_phone" type="text" name="work_phone" value="" placeholder="Telefonul tău" class="block w-full px-5 py-2.5 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg focus:outline-none"  />
                </div>

                <div class="w-full mt-4">
                    <label for="message" class="block mb-2 text-base text-gray-600">Mesajul tău</label>
                    <textarea id="message" name="message"  class="block w-full h-32 px-5 py-2.5 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg md:h-56 focus:outline-none" placeholder="Scrie aici mesajul tău."></textarea>
                    <small class="text-red-400"></small>
                </div>
                
                <button class="text-base font-normal mt-4 p-3 px-6 text-white transition-all duration-150 ease-in rounded-lg bg-main-color hover:bg-[#67083e] hover:text-link-color">
                    Trimite mesajul tău
                </button>
            </form>
        </div>
</main>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5010.0806525572025!2d24.697419357913788!3d46.78921701040125!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x474a37846674e68b%3A0x9ec286ddb3f377d7!2sStr.%20Dedradului%2016%2C%20Reghin%20545300!5e0!3m2!1sro!2sro!4v1713297773394!5m2!1sro!2sro" width="100%" class="h-screen  md:h-[540px] mx-auto w-[100dvw] ml-[calc(50%-50dvw)] mt-16" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

<? require base_path('views/partials/footer.php'); ?>
