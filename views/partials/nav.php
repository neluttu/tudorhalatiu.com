<? use Core\Session; ?>
<header class="flex items-start justify-between w-full px-2 pb-6 mx-auto mb-10 text-slate-600 max-w-7xl xl:px-0">

    <div class="lg:flex relative items-center self-stretch order-2 lg:order-1 justify-between flex-1 [&>a:hover]:text-[#ed0078] [&>a:hover]:border-b [&>a:hover]:border-[#ed0078] [&>a]:py-1 hidden">
        <span class="absolute left-0 flex items-center justify-start gap-0 text-xs top-3 text-slate-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
            <span> +40 754 784 303</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block mx-2 ml-8" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg>
            <span>contact @ tudorhalatiu . com</span>
        </span>
        <a href="/" class="<?= urlIs('/') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?>">Acasă</a>
        <a href="<?= Session::getLang(); ?>/products" class="<?= urlIs('/products') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?>">Shop</a>
        <a href="/despre" class="<?= urlIs('/despre') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?> ">Despre</a>
        <a href="/contact" class="<?= urlIs('/contact') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?> ">Contact</a>
    </div>

    <a href="/" title="" class="order-1 px-0 lg:px-16 lg:order-2 shrink-0">
        <img src="/public/images/logo2.png" width="140" alt="" class="w-[100px] lg:w-[140px]">
    </a>

    <div class="flex items-center self-stretch order-3 justify-end gap-6 lg:gap-0 lg:justify-between flex-1 [&>a:hover]:text-[#ed0078] [&>a:hover]:border-b [&>a:hover]:border-[#ed0078] [&>a]:py-1">
        <a href="<?= Session::getLang(); ?>/products" class="<?= urlIs('/products') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?> inline-block lg:hidden">Shop</a>
        <? if($_SESSION['user'] ?? false) : ?>
            <a href="<?= Session::getLang(); ?>/account" class="<?= urlIs('/account') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?>">
                <span class="hidden lg:inline-block">Contul meu</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block lg:hidden" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
            </a>
        <? else : ?>
            <a href="<?= Session::getLang(); ?>/register" class="<?= urlIs('/register') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?>">Înregistrare</a>
            <a href="<?= Session::getLang(); ?>/login" class="<?= urlIs('/login') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?>">Contul meu</a>
        <? endif; ?>  
        <a href="/cart" class="<?= urlIs('/cart') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?> " title="<?php echo Core\ShoppingCart::getCartPrice(); ?>">
            <span class="hidden md:inline-block">Coș cumpărături</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block shrink-0 md:hidden" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
            (<?php echo Core\ShoppingCart::getTotalItemsInCart(); ?>)
        </a>
        <? if(Session::isAdmin()) : ?>
            <a href="<?= Session::getLang(); ?>/admin" class="<?= urlIs('/admin') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?>"><?= \Core\Lang::text('nav.admin') ?></a>
        <? endif ?>
        <? if($_SESSION['user'] ?? false) : ?>
            <form method="post" action="<?= Session::getLang(); ?>/logout" class="hidden lg:inline-block">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="hover:text-[#ed0078] hover:border-b hover:border-[#ed0078]">
                    Logout
                </button>
            </form>
        <? endif; ?>        
        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block cursor-pointer lg:hidden transition-all duration-150 ease-in hover:stroke-[#ed0078]" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 6h16" /><path d="M7 12h13" /><path d="M10 18h10" /></svg>
    </div>
    
</header>
