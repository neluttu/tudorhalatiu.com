<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main>
    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="mb-4 text-2xl font-semibold">Online shopping, choose your category:</h1>
        <ul class="flex flex-wrap items-center justify-start gap-6 [&>li]:shadow-[0px_13px_15px_-8px_rgba(31,36,59,0.2)] [&>li:hover]:bg-[#bac1df] mt-10 [&>li]:transition-all [&>li]:duration-150 [&>li]:ease-in  [&>li]:cursor-pointer">
        <? foreach($categories as $category) : ?>
            <li class="w-full sm:w-[48%] lg:w-[30%] p-6 min-h-[100px] rounded-md relative flex items-center justify-center flex-col self-stretch">
                <a href="<?= \Core\Session::getLang(); ?>/products/<?=slug($category['name']);?>" class="text-lg font-semibold">
                    <img src="/public/images/categories/<?=$category['category_id'];?>.png" class="w-full mb-3">
                    <?=$category['name']; ?> (<?=$category['count']?> items)
                </a>
            </li>
        <? endforeach ?>
        </ul>
    </div>
</main>
<? require base_path('views/partials/footer.php'); ?>