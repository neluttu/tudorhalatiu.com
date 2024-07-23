<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

<main class="mx-auto max-w-7xl">
    <div class="py-6 sm:px-6 lg:px-8 [&>p]:mb-10 [&>p]:font-[200] px-2">
        <?= d($result) ?>
        Ne pare rau, dar plata nu a fost acceptata... 
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>