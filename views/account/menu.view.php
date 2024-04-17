
<!-- <a href="<?= Core\Session::getLang(); ?>/account" class="<?= urlIs('/account') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?> ">Detalii cont</a> -->
<a href="<?= Core\Session::getLang(); ?>/account/orders" class="<?= (urlIs('/account/orders') or urlIs('/account')) ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?> ">Comenzi din magazin</a>
<a href="<?= Core\Session::getLang(); ?>/account/addresses" class="<?= urlIs('/account/addresses') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?> ">Adrese livrare și facturare</a>
<hr class="w-full my-4 border-b-2 border-slate-700">