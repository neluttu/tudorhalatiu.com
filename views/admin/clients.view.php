<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main class="flex flex-col items-start justify-start w-full gap-6 px-2 mt-2 md:mt-10 md:flex-row max-w-7xl">
<div class="flex shrink-0 flex-row md:flex-col flex-wrap items-start md:justify-center w-full md:w-64 gap-3 text-slate-600  [&>a]:border-b [&>a]:border-transparent  [&>a:hover]:text-main-color [&>a:hover]:border-b [&>a:hover]:border-main-color">
        <? require base_path('views/admin/menu.view.php') ?>
    </div>
    <div class="w-full md:grow">
        <h1 class="text-lg">Clienți magazin virtual:</h1>
        <div class="flex flex-col items-start justify-center w-full gap-2 mt-10 text-sm">
            <? foreach($clients as $client) : ?>
                <div class="flex items-center justify-start w-full gap-4 p-2 border rounded-md">
                    <span class="grow"><?= $client['firstname'] . ' ' . $client['lastname'] ?></span>
                    <span><?= $client['status']?></span>
                </div>

            <? endforeach ?>
        </div>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>
