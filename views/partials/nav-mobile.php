<?
use Core\Session;
?>
<div class="fixed top-0 bottom-0 left-0 right-0 hidden overflow-auto min-h-screen transition duration-150 ease-in-out z-[999] bg-black/90 backdrop-blur-sm" id="mobileMenu" onclick="mobileHandler()">
    <div class="w-full px-10 py-4 mx-auto text-white md:w-full [&>a]:text-lg flex items-start justify-start gap-3 flex-col relative">
        <a href="/" title="Tudor Halațiu" class="block mx-auto mb-4"><img src="/public/images/logo-inverted.png" width="140" alt="" class="w-[100px]"></a>

        <a href="<?= Session::getLang(); ?>/" title="" class="<?= urlIs('/') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?>">Acasă</a>
        <a href="<?= Session::getLang(); ?>/shop" title="" class="<?= urlIs('/shop') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?>" title="">Shop</a>
        
        <a href="<?= Session::getLang(); ?>/contact" title="" class="<?= urlIs('/contact') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?>" title="">Contact</a>
        
        <? if($_SESSION['user'] ?? false) : ?>
            <a href="<?= Session::getLang(); ?>/account" class="<?= urlIs('/account') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?>">Contul meu</a>
        <? else : ?>
            <a href="<?= Session::getLang(); ?>/register" class="<?= urlIs('/register') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?>">Înregistrare</a>
            <a href="<?= Session::getLang(); ?>/login" class="<?= urlIs('/login') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?>">Contul meu</a>
        <? endif; ?>  
        <a href="/cart" class="<?= urlIs('/cart') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?> " title="<?php echo Core\ShoppingCart::getCartPrice(); ?>">
            Coș cumpărături (<? echo Core\ShoppingCart::getTotalItemsInCart(); ?>)
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
        
        <small class="absolute bottom-4 left-4">Copyright &copy; TudorHalatiu.com</small>

        <button class="absolute right-0 mt-2 mr-2 text-gray-400 transition duration-150 ease-in-out rounded cursor-pointer top-3 hover:text-gray-600 focus:ring-2 focus:outline-none focus:ring-gray-600" onclick="mobileHandler()" aria-label="close modal" role="button">
            <svg  xmlns="http://www.w3.org/2000/svg"  class="" width="32" height="32" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <line x1="18" y1="6" x2="6" y2="18" />
                <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
        </button>
        
    </div>
</div>