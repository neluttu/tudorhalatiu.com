<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main class="flex items-start justify-start w-full gap-6 px-2 mt-10 max-w-7xl">
    <div class="flex flex-col items-start justify-center w-1/5 gap-3 shrink-0 text-slate-600 border-b [&>a]:border-b [&>a]:border-transparent  [&>a:hover]:text-[#ed0078] [&>a:hover]:border-b [&>a:hover]:border-[#ed0078]">
        <a href="#">Comenzi</a>
        <a href="#">Clienti</a>
        <a href="#">Produse</a>
        <a href="#">Facturi emise</a>
        <a href="#">Newsletter</a>
        <hr class="w-full my-4 border-b-2 border-slate-700">
        <a href="#">Caută comanda cu ID:</a>
        <label for="order_id" class="flex justify-center w-full gap-2 items-bottom">
            <input type="number" name="order_id" value="" class="border-b-2 outline-none w-36 border-slate-200">
            <button type="submit" class="p-2 border rounded-md grow">
                Caută
            </button>
        </label>
        
    </div>
    <div>
        <h1 class="text-lg">Comenzi magazin virtual:</h1>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>
