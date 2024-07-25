<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

<main class="w-full mx-auto max-w-7xl">
    <div class="py-6 sm:px-6 lg:px-8 [&>p]:mb-2 [&>p]:font-[200] px-2">
        <p>
            Plata online a fost efectuată cu succes! 
        </p>
        <p>
            Pe adresa de email furnizată vei primit un email cu detaliile legate de comanda ta.
        
        Poți accesa comanda ta online făcând <a href="<?= $order_url ?>" class="underline text-main-color">click aici</a>.</p>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>