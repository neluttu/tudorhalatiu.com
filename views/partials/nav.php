<? use Core\Session; ?>
<header class="sticky top-0 z-30 w-full bg-white/70 backdrop-blur-sm text-slate-600">
    <!-- <div class="fixed w-1/4 -translate-x-1/2 bg-red-300 rounded-full -top-[550px] aspect-square left-1/2 blur-3xl opacity-40 -z-20"></div> -->
    <div class="flex items-start justify-between w-full px-1 pb-2 mx-auto max-w-7xl sm:px-2">
        <nav class="relative items-center self-stretch justify-between flex-1 order-2 hidden pt-5 lg:flex lg:order-1">
            <ul class="w-full [&>li:hover]:text-main-color [&>li:hover]:border-b [&>li:hover]:border-main-color [&>li]:py-1 flex justify-between items-center">
                <li class="<?= urlIs('/') ? 'border-b border-main-color text-main-color' : '' ?>"><a href="/" title="Tudor Halațiu">Acasă</a></li>
                <li class="<?= urlIs('/shop') ? 'border-b border-main-color text-main-color' : '' ?>"><a href="<?= Session::getLang(); ?>/shop" title="Shop - magazin online Tudor Halațiu">Shop</a></li>
                <!-- <li class="<?= urlIs('/sale') ? 'border-b border-main-color text-main-color' : '' ?> bg-main-color text-white px-4 rounded-md"><a href="<?= Session::getLang(); ?>/sale" title="Shop - magazin online Tudor Halațiu">Reduceri</a></li> -->
                <li class="<?= urlIs('/despre') ? 'border-b border-main-color text-main-color' : '' ?>"><a href="/despre" title="Despre Tudor Halațiu">Despre</a></li>
                <li class="<?= urlIs('/contact') ? 'border-b border-main-color text-main-color' : '' ?>"><a href="/contact" title="Informații contact shop magazin online Tudor Halațiu">Contact</a></li>
            </ul>
        </nav>

        <a href="/" title="Tudor Halațiu" class="order-1 px-0 lg:px-16 lg:order-2 shrink-0">
            <img src="/public/images/tudor-halatiu-logo.svg" width="140" class="w-[70px] md:w-[100px] pt-2" alt="tudorhalatiu.com" loading="lazy">
        </a>

        <div class="flex items-center self-stretch order-3 justify-end gap-3 sm:gap-6 lg:gap-0 lg:justify-between flex-1 [&>a:hover]:text-main-color [&>a:hover]:border-b [&>a:hover]:border-main-color [&>a]:py-1 pt-2 md:pt-5">
            <a href="<?= Session::getLang(); ?>/shop" class="<?= urlIs('/shop') ? 'border-b border-main-color text-main-color' : '' ?> inline-block lg:hidden" title="Shop - Magazin online Tudor Halațiu">Shop</a>
            <? if($_SESSION['user'] ?? false) : ?>
                <a href="<?= Session::getLang(); ?>/account" class="<?= urlIs('/account') ? 'border-b border-main-color text-main-color' : '' ?>" title="Cont client shop Tudor Halațiu">
                    <span class="hidden sm:inline-block">Contul meu</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block sm:hidden" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                </a>
            <? else : ?>
                <a href="<?= Session::getLang(); ?>/register" class="<?= urlIs('/register') ? 'border-b border-main-color text-main-color' : '' ?> hidden sm:block" title="Cumpără din contul tău de client">Înregistrare</a>
                <a href="<?= Session::getLang(); ?>/login" class="<?= urlIs('/login') ? 'border-b border-main-color text-main-color' : '' ?> hidden sm:block"  title="Autentificare cont client Tudor Halațiu">Contul meu</a>
            <? endif; ?>  
            <a href="/cart" class="<?= urlIs('/cart') ? 'border-b border-main-color text-main-color' : '' ?> " title="<?php echo Core\ShoppingCart::getCartPrice(); ?>">
                <span class="hidden md:inline-block">Coș cumpărături</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block shrink-0 md:hidden" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
                (<?php echo Core\ShoppingCart::getTotalItemsInCart(); ?>)
            </a>
            <? if(Session::isAdmin()) : ?>
                <a href="<?= Session::getLang(); ?>/admin" class="<?= urlIs('/admin') ? 'border-b border-main-color text-main-color' : '' ?> hidden sm:block"><?= \Core\Lang::text('nav.admin') ?></a>
            <? endif ?>
            <? if($_SESSION['user'] ?? false) : ?>
                <form method="post" action="<?= Session::getLang(); ?>/logout" class="hidden lg:inline-block">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="hover:text-main-color hover:border-b hover:border-main-color">
                        Logout
                    </button>
                </form>
            <? endif; ?>        
            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block transition-all duration-150 ease-in cursor-pointer mobileMenuToggle lg:hidden hover:stroke-main-color" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <path d="M4 6h16" />
                <path d="M7 12h13" />
                <path d="M10 18h10" />
            </svg>
            <? require base_path('views/partials/nav-mobile.php') ?>
        </div>
    </div>
</header>
<div class="items-center justify-end hidden w-full gap-2 px-2 font-sans text-sm md:flex max-w-7xl text-slate-400">
    <a href="https://www.instagram.com/tudorhalatiu/" title="Tudor Halațiu Instagram" target="_blank" class="group">
            <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:stroke-main-color" width="28" height="28" viewBox="0 0 24 24" stroke-width="1" stroke="#65676d" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <rect x="4" y="4" width="16" height="16" rx="4"></rect>
                <circle cx="12" cy="12" r="3"></circle>
                <line x1="16.5" y1="7.5" x2="16.5" y2="7.501"></line>
            </svg>
        </a>
        <a href="https://www.facebook.com/tudor.halatiu/" title="Tudor Halațiu Facebook" target="_blank" class="group">
            <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:stroke-main-color" width="28" height="28" viewBox="0 0 24 24" stroke-width="1" stroke="#65676d" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
            </svg>
        </a>
</div>
