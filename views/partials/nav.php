<? use Core\Session; ?>
<header class="flex items-start justify-between w-full px-2 pb-6 mx-auto mb-10 border-b text-slate-600 max-w-7xl border-slate-200 xl:px-0">
        <div class="lg:flex items-center self-stretch order-2 lg:order-1 justify-between flex-1 [&>a:hover]:text-[#ed0078] [&>a:hover]:border-b [&>a:hover]:border-[#ed0078] [&>a]:py-1 hidden">
            <a href="/" class="<?= urlIs('/') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?>">Acasă</a>
            <a href="<?= Session::getLang(); ?>/products" class="<?= urlIs('/products') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?>">Shop</a>
            <a href="/about" class="<?= urlIs('/about') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?> ">Despre</a>
            <a href="/contact" class="<?= urlIs('/contact') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?> ">Contact</a>
        </div>
        <a href="/" title="" class="order-1 px-0 lg:px-16 lg:order-2 shrink-0">
            <img src="/public/images/logo2.png" width="140" alt="" class="w-[100px] lg:w-[140px]">
        </a>
        <div class="flex items-center self-stretch order-3 justify-between flex-1 [&>a:hover]:text-[#ed0078] [&>a:hover]:border-b [&>a:hover]:border-[#ed0078] [&>a]:py-1">
            <a href="<?= Session::getLang(); ?>/products" class="<?= urlIs('/products') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?> inline-block lg:hidden">Shop</a>
            <? if($_SESSION['user'] ?? false) : ?>
                <a href="<?= Session::getLang(); ?>/account" class="<?= urlIs('/account') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?>">Contul meu</a>
            <? else : ?>
                <a href="<?= Session::getLang(); ?>/register" class="<?= urlIs('/register') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?>">Înregistrare</a>
                <a href="<?= Session::getLang(); ?>/login" class="<?= urlIs('/login') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?>">Contul meu</a>
            <? endif; ?>  
            <a href="/cart" class="<?= urlIs('/cart') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?> " title="<?php echo Core\ShoppingCart::getCartPrice(); ?>">Coș cumpărături (<?php echo Core\ShoppingCart::getTotalItemsInCart(); ?>)</a>
            <? if(Session::isAdmin()) : ?>
                <a href="<?= Session::getLang(); ?>/admin" class="<?= urlIs('/admin') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?>"><?= \Core\Lang::text('nav.admin') ?></a>
            <? endif ?>
            <? if($_SESSION['user'] ?? false) : ?>
                      <form method="post" action="<?= Session::getLang(); ?>/logout">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="hover:text-[#ed0078] hover:border-b hover:border-[#ed0078]">
                            Logout
                        </button>
                      </form>
            <? endif; ?>        
            <!-- <svg xmlns="http://www.w3.org/2000/svg" class="" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="#666" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                <path d="M17 17h-11v-14h-2" />
                <path d="M6 5l14 1l-1 7h-13" />
              </svg> -->
        </div>
    </header>
    <!-- <img src="/public/images/eg.png"> -->