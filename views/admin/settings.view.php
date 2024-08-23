<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main class="flex items-start justify-start w-full gap-6 px-2 mt-10 max-w-7xl">
    <div class="flex flex-col items-start justify-center w-1/5 gap-3 shrink-0 text-slate-600 border-b [&>a]:border-b [&>a]:border-transparent  [&>a:hover]:text-[#ed0078] [&>a:hover]:border-b [&>a:hover]:border-[#ed0078]">
        <? require base_path('views/admin/menu.view.php') ?>        
    </div>
    <div>
        <div class="flex flex-wrap items-start justify-center w-full mt-4 md:gap-3 md:gap-y-1 text-slate-700">
        <? foreach ($settings as $setting) : ?>
                <span class="w-full py-2 text-sm font-normal md:w-auto md:flex-1"><?= $setting['echo'] ?>:</span>
                <label class="w-full mb-2 border rounded-md bg-slate-50 md:w-auto md:flex-1">
                    <input type="text" name="<?= $setting['name'] ?>" value="<?= $setting['value'] ?>" class="w-full px-2 py-2 text-sm bg-transparent outline-none">
                </label>
                <span class="w-full"></span>
        <? endforeach ?>
        </div>
    </div>
</main>
<? require base_path('views/partials/footer.php'); ?>
