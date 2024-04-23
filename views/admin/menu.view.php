<a href="/admin" class="<?= urlIs('/admin') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?> ">Comenzi</a>
<a href="/admin/products" class="<?= urlIs('/admin/products') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?> ">Produse</a>
<a href="/admin/categories" class="<?= urlIs('/admin/categories') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?> ">Categorii</a>
<a href="/admin/clienti" class="<?= urlIs('/admin/clienti') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?> ">Clienti</a>
<!-- <a href="/admin/facturi" class="<?= urlIs('/admin/facturi') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?> ">Facturi emise</a> -->
<a href="/admin/newsletter" class="<?= urlIs('/admin/newsletter') ? 'border-b border-[#ed0078] text-[#ed0078]' : '' ?> ">Newsletter</a>
<hr class="w-full my-4 border-b-2 border-slate-700">
<a href="#">Caută comanda cu ID:</a>
<label for="order_id" class="flex justify-center w-full gap-2 items-bottom">
    <input type="number" name="order_id" value="" class="border-b-2 outline-none w-36 border-slate-200">
    <button type="submit" class="p-2 border rounded-md grow">
        Caută
    </button>
</label>
