
<a href="<?= Core\Session::getLang(); ?>/account" class="<?= urlIs('/account') ? 'border-b border-main-color text-main-color' : '' ?>">Detalii cont</a>
<a href="<?= Core\Session::getLang(); ?>/account/orders" class="<?= (urlIs('/account/orders')) ? 'border-b border-main-color text-main-color' : '' ?>">Comenzi din magazin</a>
<a href="<?= Core\Session::getLang(); ?>/account/addresses" class="<?= urlIs('/account/addresses') ? 'border-b border-main-color text-main-color' : '' ?>">Adrese livrare și facturare</a>
<hr class="w-full my-4 border-b-2 border-slate-700">